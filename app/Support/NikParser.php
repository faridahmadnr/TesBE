<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class NikParser
{
    private string $cacheKey = 'data-wilayah';

    private $nik;

    public function __construct($nik)
    {
        $this->nik = $nik;
    }

    public function isValid()
    {
        return $this->isValidLength() &&
               $this->isValidProvince() &&
               $this->isValidKabupatenKota() &&
               $this->isValidKecamatan();
    }

    private function getCacheKey()
    {
        return sha1($this->cacheKey); // skipcq: PHP-A1004
    }

    private function isValidLength()
    {
        return strlen($this->nik) === 16;
    }

    private function isValidProvince()
    {
        return ! empty($this->province());
    }

    private function isValidKabupatenKota()
    {
        return ! empty($this->kabupatenKota());
    }

    private function isValidKecamatan()
    {
        return ! empty($this->kecamatan());
    }

    public function provinceId()
    {
        return substr($this->nik, 0, 2);
    }

    public function province()
    {
        $wilayah = Cache::rememberForever($this->getCacheKey(), function () {
            return json_decode(file_get_contents(storage_path('app/data/wilayah.json')), true);
        });

        return $wilayah['provinsi'][$this->provinceId()];
    }

    public function kabupatenKotaId()
    {
        return substr($this->nik, 0, 4);
    }

    public function kabupatenKota()
    {
        $wilayah = Cache::get($this->getCacheKey());

        return $wilayah['kabkot'][$this->kabupatenKotaId()];
    }

    public function kecamatanId()
    {
        return substr($this->nik, 0, 6);
    }

    public function kecamatan()
    {
        $wilayah = Cache::get($this->getCacheKey());

        return explode(' -- ', $wilayah['kecamatan'][$this->kecamatanId()])[0];
    }

    public function kodepos()
    {
        $wilayah = Cache::get($this->getCacheKey());

        return substr($wilayah['kecamatan'][$this->kecamatanId()], -5);
    }

    public function kelamin()
    {
        return $this->lahir()->format('d') < 40 ? 'pria' : 'wanita';
    }

    public function lahir()
    {
        $year = (int) substr($this->nik, 10, 2);
        $month = (int) substr($this->nik, 8, 2);
        $date = (int) substr($this->nik, 6, 2);

        return \Carbon\Carbon::create($year, $month, $date);
    }

    public function uniqcode()
    {
        return substr($this->nik, 12, 4);
    }
}
