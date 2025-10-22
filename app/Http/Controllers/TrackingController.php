<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        // $enrichmentData = $this->getEnrichmentData($user_id);
        try {
            //Validate data yang masuk dari frontend (ini masi sementara, buat nyoba dl)
            $validatedData = $request->validate([
                'user_id' => 'required|string|max:255',
                'event_name' => 'required|string|max:255',
                'event_properties' => 'nullable|json',
            ]);

            // $enrichmentData = [];


            //Simpan data ke database pake Model Event yg udh dibuat
            //makesure event_properties diubah jd array dl, !!implementasi realnya pake jsnon!!
            $event = Event::create($validatedData);

            //201 untuk resource berhasil dibuat ^^
            return response()->json([
                'message' => 'Event berhasil dicatat',
                'data' => $event,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            //kl misal data ga valid
            Log::error('Validation Error while storing event', ['errors' => $e->errors()]);
            return response()->json([
                'message' => 'Validasi data gagal.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // handle any other error
            Log::error('General Error while storing event', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Terjadi kesalahan pada server. Mohon coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
 
    }


    // private function getEnrichmentData(string $userId): array
    // {

    //     $user = DB::table('users')->where('id', $userId)->first();
    //     if (!$user) {
    //         return [];
    //     }
        
    //     $permissionDetails = [];
    //     $sessionData = null;

    //     //session
    //     $sessionData = DB::table('sessions')
    //         ->where('user_id', $userId)
    //         ->latest('last_activity')
    //         ->select('ip_address', 'user_agent')
    //         ->first();

    //     // ?
    //     $roleRecord = DB::table('model_has_roles')
    //         ->where('model_id', $userId)
    //         ->where('model_type', 'App\Models\User')
    //         ->first();

    //     if ($roleRecord) {
    //         $roleId = $roleRecord->role_id;
            
        
    //         $permissionIds = DB::table('role_has_permissions')
    //             ->where('role_id', $roleId)
    //             ->pluck('permission_id')
    //             ->toArray();
                
        
    //         if (!empty($permissionIds)) {
    //             $permissionDetails = DB::table('permissions')
    //                 ->whereIn('id', $permissionIds)
    //                 ->select('name', 'description')
    //                 ->get()
    //                 ->toArray();
    //         }
    //     }

    //     return [
    //         'user_profile' => (array) $user,
    //         'access_control' => [
    //             'role_id' => $roleId ?? null,
    //             'permissions' => $permissionDetails
    //         ],
    //         'sessions_info' => $sessionData,
    //     ];
    // }
                

}