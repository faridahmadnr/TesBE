<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Faq\Entities\Faq;
use Modules\News\Entities\News;
use Modules\Requirement\Entities\Requirement;
use Modules\Termin\Entities\Termin;
use Storage;

class MigrateData extends Command
{
    use DisableForeignKeys;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data lama ke data baru';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->confirm('Are you sure you want to migrate data?');
        $this->info('Start Migrate Data');

        $this->disableForeignKeys();
        $this->migrateUser();
        $this->getOldNews();
        $this->getOldRequirement();
        $this->getOldFaq();
        $this->enableForeignKeys();

        $this->info('Finish Migrate Data');
    }

    private function getDataFromCsv($file)
    {
        $file = fopen($file, 'r');
        $data = [];
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }
        fclose($file);

        return $data;
    }

    private function migrateUser()
    {
        try {
            DB::beginTransaction();

            DB::table('model_has_roles')->where('model_id', '!=', 1)->delete();
            DB::table('users')->where('id', '!=', 1)->delete();
            DB::table('members')->truncate();
            DB::table('credit_requests')->truncate();

            $userPath = str_replace('\\', '/', storage_path('app/data/backup/users.csv'));
            $memberPath = str_replace('\\', '/', storage_path('app/data/backup/members.csv'));

            $oldDataRoles = [
                'Admin OJK',
                'Admin Bank',
                'Sub Admin Bank',
                'Supervisor',
            ];

            $users = [];
            $userRoles = [];

            $lastUserId = DB::table('users')->max('id');
            $roles = DB::table('roles')->pluck('id', 'description')->toArray();

            $this->info('Start migrating data');
            foreach ($this->getDataFromCsv($userPath) as $user) {
                $roleId = $roles[$oldDataRoles[$user[6]]];

                if ($user[2] === 'kur@jogjaprov.go.id') {
                    $roleId = 1;
                }

                $userId = $lastUserId + 1;
                $users[] = [
                    'id' => $userId,
                    'name' => $user[1],
                    'email' => $user[2],
                    'email_verified_at' => Carbon::parse($user[11]),
                    'password' => $user[4],
                    'password_changed_at' => null,
                    'active' => 1,
                    'last_login_at' => null,
                    'last_login_ip' => null,
                    'status' => 1,
                    'remember_token' => null,
                    'created_at' => Carbon::parse($user[11]),
                    'updated_at' => Carbon::parse($user[12]),
                    'deleted_at' => null,
                ];
                $userRoles[] = [
                    'role_id' => $roleId,
                    'model_type' => 'Modules\User\Entities\User',
                    'model_id' => $userId,
                ];
                $lastUserId++;
                $this->info('User '.$user[1].' migrated');
            }

            $lastMemberId = DB::table('members')->max('id');
            $roleMemberId = DB::table('roles')->where('description', 'Member')->first()->id;

            $oldMembers = $this->getDataFromCsv($memberPath);
            $members = [];
            foreach ($oldMembers as $user) {
                $userId = collect($users)->where('email', '=', $user[3])->first();

                if (! $userId) {
                    $userId = $lastUserId + 1;
                    $users[] = [
                        'id' => $userId,
                        'name' => $user[2],
                        'email' => $user[3],
                        'email_verified_at' => Carbon::parse($user[9]),
                        'password' => $user[4],
                        'password_changed_at' => null,
                        'active' => $user[14],
                        'last_login_at' => null,
                        'last_login_ip' => null,
                        'status' => $user[15],
                        'remember_token' => null,
                        'created_at' => Carbon::parse($user[9]),
                        'updated_at' => Carbon::parse($user[10]),
                        'deleted_at' => null,
                    ];
                    $userRoles[] = [
                        'role_id' => $roleMemberId,
                        'model_type' => 'Modules\User\Entities\User',
                        'model_id' => $userId,
                    ];
                } else {
                    $userId = $userId['id'];
                }

                $userRoleIndex = array_search($userId, array_column($userRoles, 'model_id'));
                if ($userRoleIndex) {
                    $userRoles[$userRoleIndex]['role_id'] = $roleMemberId;
                }

                $members[] = [
                    'id' => $lastMemberId + 1,
                    'user_id' => $userId,
                    'identity_number' => Crypt::encryptString($user[1]),
                    'phone' => $user[5] ? Crypt::encryptString($user[5]) : null,
                    'second_phone' => $user[12] ? Crypt::encryptString($user[12]) : null,
                    'address' => $user[6] ? Crypt::encryptString($user[6]) : null,
                    'gender' => $user[7] === '1' ? 'male' : 'female',
                    'dob' => Carbon::parse($user[8]),
                    'photo' => null,
                    'created_by' => null,
                    'updated_by' => null,
                    'deleted_by' => null,
                    'created_at' => Carbon::parse($user[9]),
                    'updated_at' => Carbon::parse($user[10]),
                    'deleted_at' => null,
                ];
                $this->info('Member '.$user[2].' migrated');
                $lastUserId++;
                $lastMemberId++;
            }

            $creditRequestPath = str_replace('\\', '/', storage_path('app/data/backup/credit_requests.csv'));
            $creditRequests = [];
            $lastCreditRequestId = DB::table('credit_requests')->max('id');

            $oldBusinessTypes = $this->getOldBusinessTypes();
            $businessTypes = DB::table('business_types')->get();

            $oldBusinessPermits = $this->getOldBusinessPermits();
            $businessPermits = DB::table('business_permits')->get();

            $oldBusinessRegencies = $this->getOldBusinessRegency();
            $businessRegencies = DB::table('regencies')->get();

            $oldDistricts = $this->getOldDistrict();
            $districts = DB::table('districts')->get();

            $oldCreditRequestTypes = $this->getOldCreditRequestType();
            $creditRequestTypes = DB::table('credit_request_types')->get();

            $oldTermins = $this->getOldTermins();
            $termins = DB::table('termins')->get();

            $this->info('Get Banks');
            $oldBanks = $this->getOldBanks();
            $banks = DB::table('banks')->get();

            $oldMembers = collect($oldMembers)->map(function ($member) {
                return [
                    'id' => $member[0],
                    'name' => $member[1],
                    'email' => $member[3],
                ];
            });
            $newUsers = collect($users);

            $this->info('Start migrating credit requests');
            foreach ($this->getDataFromCsv($creditRequestPath) as $creditrequest) {
                $oldBusinessTypeId = $oldBusinessTypes->firstWhere('id', $creditrequest[3]);
                $businessTypeId = $businessTypes->firstWhere('name', $oldBusinessTypeId['name'])->id ?? false;

                if (! $businessTypeId) {
                    $this->error('Business type '.$oldBusinessTypeId['name'].' not found');

                    continue;
                }

                $oldBusinessPermitId = $oldBusinessPermits->firstWhere('id', $creditrequest[4]);
                $businessPermitId = $businessPermits->firstWhere('name', $oldBusinessPermitId['name'])->id ?? false;

                if (! $businessPermitId) {
                    $this->error('Business permit '.$oldBusinessPermitId['name'].' not found');

                    continue;
                }

                $oldBusinessRegencyId = $oldBusinessRegencies->firstWhere('id', $creditrequest[8]);
                $businessRegencyId = $businessRegencies->firstWhere('name', $oldBusinessRegencyId['name'])->id ?? false;

                if (! $businessRegencyId) {
                    $this->error('Business regency '.$oldBusinessRegencyId['name'].' not found');

                    continue;
                }

                $oldDistrictId = $oldDistricts->firstWhere('id', $creditrequest[9]);
                $districtId = $districts->firstWhere('name', $oldDistrictId['name'])->id ?? false;

                if (! $districtId) {
                    $this->error('District '.$oldDistrictId['name'].' not found');

                    continue;
                }

                $oldCreditRequestTypeId = $oldCreditRequestTypes->firstWhere('id', $creditrequest[12]);
                $creditRequestTypeId = $creditRequestTypes->firstWhere('name', $oldCreditRequestTypeId['name'])->id ?? false;

                if (! $creditRequestTypeId) {
                    $this->error('Credit request type '.$oldCreditRequestTypeId['name'].' not found');

                    continue;
                }

                $oldTerminId = $oldTermins->firstWhere('id', $creditrequest[14]);
                $terminId = $termins->firstWhere('name', $oldTerminId['name'])->id ?? false;

                if (! $terminId) {
                    $this->error('Termin '.$oldTerminId['name'].' not found');

                    continue;
                }

                $oldBankId = $oldBanks->firstWhere('id', $creditrequest[15]);
                $bankId = $banks->firstWhere('name', $oldBankId['name'])->id ?? false;

                if (! $bankId) {
                    $this->error('Bank '.$oldBankId['name'].' not found');

                    continue;
                }

                $oldUserId = $oldMembers->firstWhere('id', $creditrequest[2]);
                $userId = $newUsers->firstWhere('email', $oldUserId['email'])['id'] ?? false;

                if (! $userId) {
                    $this->error('User '.$oldUserId['email'].' not found');

                    continue;
                }

                $creditRequestStatus = CreditRequestStatusEnum::fromValue(strtolower($creditrequest[16]));

                $creditrequestId = $lastCreditRequestId + 1;
                $creditRequests[] = [
                    'id' => $creditrequestId,
                    'registration_number' => trim($creditrequest[1] ?? ''),
                    'user_id' => $userId,
                    'business_type_id' => $businessTypeId,
                    'business_permit_id' => $businessPermitId,
                    'business_tin' => $creditrequest[5] ?? null,
                    'image' => $creditrequest[6] ?? null,
                    'business_address' => $creditrequest[7] ?? null,
                    'business_regency_id' => $businessRegencyId,
                    'business_district_id' => $districtId,
                    'village' => $creditrequest[10] ?? null,
                    'postal_code' => $creditrequest[11] ?? null,
                    'credit_request_type_id' => $creditRequestTypeId,
                    'termin_id' => $terminId,
                    'bank_id' => $bankId,
                    'amount' => $creditrequest[13] ?? null,
                    'status' => $creditRequestStatus->value,
                    'created_by' => $userId,
                    'updated_by' => null,
                    'deleted_by' => null,
                    'created_at' => Carbon::parse($creditrequest[17]),
                    'updated_at' => Carbon::parse($creditrequest[18]),
                    'deleted_at' => null,
                    'remark' => '',
                ];
                $lastCreditRequestId++;
                $this->info('Credit request '.$creditrequest[1].' migrated');
            }

            $this->info('Start migrating data');

            DB::table('users')->insert($users);
            DB::table('members')->insert($members);
            DB::table('model_has_roles')->insert($userRoles);
            DB::table('credit_requests')->insert($creditRequests);
            $this->info('End migrating data');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error($th->getMessage());
        }
    }

    private function getOldBusinessTypes()
    {
        DB::table('business_types')->truncate();
        $businessTypesPath = str_replace('\\', '/', storage_path('app/data/backup/business_types.csv'));
        $businessTypes = $this->getDataFromCsv($businessTypesPath);

        $insertedData = array_map(fn ($businessType) => ['name' => $businessType[1]], $businessTypes);
        BusinessType::insert($insertedData);

        return collect($businessTypes)->map(function ($businessType) {
            return [
                'id' => $this->_removeUnusedChar($businessType[0]),
                'name' => $this->_removeUnusedChar($businessType[1]),
            ];
        });
    }

    private function getOldBusinessPermits()
    {
        DB::table('business_permits')->truncate();
        $businessPermitsPath = str_replace('\\', '/', storage_path('app/data/backup/business_permits.csv'));
        $businessPermits = $this->getDataFromCsv($businessPermitsPath);

        $insertedData = array_map(fn ($businessPermit) => ['name' => $businessPermit[1]], $businessPermits);
        BusinessPermit::insert($insertedData);

        return collect($businessPermits)->map(function ($businessPermit) {
            return [
                'id' => $this->_removeUnusedChar($businessPermit[0]),
                'name' => $this->_removeUnusedChar($businessPermit[1]),
            ];
        });
    }

    private function getOldBusinessRegency()
    {
        $businessRegencyPath = str_replace('\\', '/', storage_path('app/data/backup/regencies.csv'));
        $businessRegencies = $this->getDataFromCsv($businessRegencyPath);

        return collect($businessRegencies)->map(function ($regency) {
            return [
                'id' => $this->_removeUnusedChar($regency[0]),
                'name' => $this->_removeUnusedChar($regency[2]),
            ];
        });
    }

    private function getOldDistrict()
    {
        $districtPath = str_replace('\\', '/', storage_path('app/data/backup/districts.csv'));
        $districts = $this->getDataFromCsv($districtPath);

        return collect($districts)->map(function ($district) {
            return [
                'id' => $this->_removeUnusedChar($district[0]),
                'name' => $this->_removeUnusedChar($district[2]),
            ];
        });
    }

    private function getOldCreditRequestType()
    {
        DB::table('credit_request_types')->truncate();
        $path = str_replace('\\', '/', storage_path('app/data/backup/kur_types.csv'));
        $creditRequestTypes = $this->getDataFromCsv($path);

        $insertedData = array_map(function ($data) {
            $name = $this->_removeUnusedChar($data[1]);
            $interest = 6 / 100;
            if ($name === 'Kur Super Mikro') {
                $interest = 3 / 100;
            }

            return [
                'name' => $name,
                'min_value' => $this->_removeUnusedChar($data[2]),
                'max_value' => $this->_removeUnusedChar($data[3]),
                'interest' => $interest,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $creditRequestTypes);
        CreditRequestType::insert($insertedData);

        return collect($creditRequestTypes)->map(function ($creditRequest) {
            return [
                'id' => $this->_removeUnusedChar($creditRequest[0]),
                'name' => $this->_removeUnusedChar($creditRequest[1]),
                'min_value' => $this->_removeUnusedChar($creditRequest[2]),
                'max_value' => $this->_removeUnusedChar($creditRequest[3]),
            ];
        });
    }

    private function getOldTermins()
    {
        DB::table('termins')->truncate();
        $path = str_replace('\\', '/', storage_path('app/data/backup/termins.csv'));
        $termins = $this->getDataFromCsv($path);

        $insertedData = array_map(fn ($data) => ['name' => $data[1], 'value' => $data[2]], $termins);
        Termin::insert($insertedData);

        return collect($termins)->map(function ($termin) {
            return [
                'id' => $this->_removeUnusedChar($termin[0]),
                'name' => $this->_removeUnusedChar($termin[1]),
            ];
        });
    }

    private function getOldBanks()
    {
        DB::table('banks')->truncate();
        $path = str_replace('\\', '/', storage_path('app/data/backup/banks.csv'));
        $banks = $this->getDataFromCsv($path);

        $insertedData = [];
        foreach ($banks as $data) {
            // try {
            //     $image = file_get_contents($data[6]);
            //     $path = 'news/'.$this->_removeUnusedChar($data[1]).'.jpg';
            //     Storage::put($path, $image);
            // } catch (\Throwable $th) {
            //     $this->info('[BANK] Unable to get image');
            // }

            $insertedData[] = [
                'name' => $data[1],
                'link' => $data[2],
                'code' => $data[3],
                'status' => $data[4],
                'reason_status' => $data[5],
                'logo' => $data[6],
            ];
        }
        Bank::insert($insertedData);

        return collect($banks)->map(function ($bank) {
            return [
                'id' => $this->_removeUnusedChar($bank[0]),
                'name' => $this->_removeUnusedChar($bank[1]),
            ];
        });
    }

    private function getOldNews()
    {
        News::truncate();
        $path = str_replace('\\', '/', storage_path('app/data/backup/pages.csv'));
        $news = $this->getDataFromCsv($path);

        $insertedData = [];
        foreach ($news as $item) {
            if ($item[5] !== 'NEWS') {
                continue;
            }

            try {
                $image = file_get_contents($item[3]);
                $path = 'news/'.$this->_removeUnusedChar($item[0]).'.jpg';
                Storage::put($path, $image);
            } catch (\Throwable $th) {
                $this->info('[NEWS] Unable to get image');
            }

            $insertedData[] = [
                'title' => $item[1],
                'slug' => $item[4],
                'content' => str_replace('&nbsp;', ' ', $item[2]),
                'summary' => \Str::limit(strip_tags(str_replace('&nbsp;', ' ', $item[2])), 200),
                'featured_image' => $item[0].'.jpg',
                'status' => 1,
                'created_at' => $item[6],
            ];
        }
        News::insert($insertedData);
    }

    private function getOldRequirement()
    {
        Requirement::truncate();
        $path = str_replace('\\', '/', storage_path('app/data/backup/pages.csv'));
        $news = $this->getDataFromCsv($path);

        $insertedData = [];
        foreach ($news as $item) {
            if ($item[5] !== 'REQUIREMENT') {
                continue;
            }

            try {
                $image = file_get_contents($item[3]);
                $path = 'requirements/'.$item[0].'.jpg';
                Storage::put($path, $image);
            } catch (\Throwable $th) {
                $this->info('[REQUIREMENT] Unable to get image');
            }

            $insertedData[] = [
                'name' => $item[1],
                'summary' => $item[9],
                'description' => str_replace('&nbsp;', ' ', $item[2]),
                'image' => $item[0].'.jpg',
                'status' => 1,
                'created_at' => now(),
            ];
        }
        Requirement::insert($insertedData);
    }

    private function getOldFaq()
    {
        Faq::truncate();
        $path = str_replace('\\', '/', storage_path('app/data/backup/pages.csv'));
        $news = $this->getDataFromCsv($path);

        $insertedData = [];
        foreach ($news as $item) {
            if ($item[5] !== 'FAQ') {
                continue;
            }

            $insertedData[] = [
                'question' => $item[1],
                'answer' => str_replace('&nbsp;', ' ', $item[2]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Faq::insert($insertedData);
    }

    private function _removeUnusedChar(string $text)
    {
        return str_replace('"', '', preg_replace('/[\x{FEFF}]/u', '', $text));
    }
}
