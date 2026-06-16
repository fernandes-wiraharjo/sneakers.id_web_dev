<?php

namespace App\Http\Livewire;

use App\Facades\CekOngkir;
use App\Models\Region as ModelRegion;
use App\Support\ShippingLocation;
use Livewire\Component;

class Region extends Component
{
    public $cityList = [];
    public $districtList = [];
    public $subdistrictList = [];
    public $subdistrictRows = [];

    public $selectedProvinceId = '';
    public $selectedCityId = '';
    public $selectedDistrictId = '';
    public $selectedSubdistrictId = '';
    public $selectedPostalCode = '';

    public $selectedProvinceName = '';
    public $selectedCityName = '';
    public $selectedDistrictName = '';
    public $selectedSubdistrictName = '';

    public $savedLocation = [];

    public function mount($user_address = null)
    {
        $address = $user_address ?: (auth()->user()->user_address ?? null);

        if ($address) {
            $this->savedLocation = ShippingLocation::resolve($address);

            if ($address->subdistrict_ro_id) {
                $this->selectedSubdistrictId = (string) $address->subdistrict_ro_id;
            } elseif ($address->region_id) {
                $this->selectedSubdistrictId = (string) $address->region_id;
            }

            $this->selectedProvinceName = $this->savedLocation['province'] ?? '';
            $this->selectedCityName = $this->savedLocation['city'] ?? '';
            $this->selectedDistrictName = $this->savedLocation['district'] ?? '';
            $this->selectedSubdistrictName = $this->savedLocation['subdistrict'] ?? '';
            $this->selectedPostalCode = $this->savedLocation['postal_code'] ?? '';
            $this->restoreLocationCascade();
        }
    }

    protected function restoreLocationCascade(): void
    {
        $provinceId = $this->findLocationId(CekOngkir::getProvinces(), $this->selectedProvinceName);
        if (! $provinceId) {
            return;
        }

        $this->selectedProvinceId = $provinceId;
        $this->cityList = CekOngkir::getCities($provinceId)->all();

        $cityId = $this->findLocationId(collect($this->cityList), $this->selectedCityName);
        if (! $cityId) {
            return;
        }

        $this->selectedCityId = $cityId;
        $this->districtList = CekOngkir::getDistricts($cityId)->all();

        $districtId = $this->findLocationId(collect($this->districtList), $this->selectedDistrictName);
        if (! $districtId) {
            return;
        }

        $this->selectedDistrictId = $districtId;
        $rows = CekOngkir::getSubdistricts($districtId);
        $this->subdistrictRows = $rows->keyBy('id')->all();
        $this->subdistrictList = $rows->pluck('name', 'id')->all();
    }

    protected function findLocationId($items, ?string $name): ?string
    {
        if (! $name) {
            return null;
        }

        foreach ($items as $id => $label) {
            if (strcasecmp((string) $label, (string) $name) === 0) {
                return (string) $id;
            }
        }

        return null;
    }

    public function loadCities($provinceId)
    {
        $this->selectedProvinceId = $provinceId;
        $this->selectedProvinceName = CekOngkir::getProvinces()[$provinceId] ?? '';
        $this->cityList = CekOngkir::getCities($provinceId)->all();
        $this->selectedCityId = '';
        $this->selectedDistrictId = '';
        $this->selectedSubdistrictId = '';
        $this->districtList = [];
        $this->subdistrictList = [];
        $this->subdistrictRows = [];
        $this->selectedCityName = '';
        $this->selectedDistrictName = '';
        $this->selectedSubdistrictName = '';
        $this->selectedPostalCode = '';
    }

    public function loadDistricts($cityId)
    {
        $this->selectedCityId = $cityId;
        $this->selectedCityName = $this->cityList[$cityId] ?? '';
        $this->districtList = CekOngkir::getDistricts($cityId)->all();
        $this->selectedDistrictId = '';
        $this->selectedSubdistrictId = '';
        $this->subdistrictList = [];
        $this->subdistrictRows = [];
        $this->selectedDistrictName = '';
        $this->selectedSubdistrictName = '';
        $this->selectedPostalCode = '';
    }

    public function loadSubdistricts($districtId)
    {
        $this->selectedDistrictId = $districtId;
        $this->selectedDistrictName = $this->districtList[$districtId] ?? '';
        $rows = CekOngkir::getSubdistricts($districtId);
        $this->subdistrictRows = $rows->keyBy('id')->all();
        $this->subdistrictList = $rows->pluck('name', 'id')->all();
        $this->selectedSubdistrictId = '';
        $this->selectedSubdistrictName = '';
        $this->selectedPostalCode = '';
    }

    public function selectSubdistrict($subdistrictId)
    {
        $subdistrictId = (string) $subdistrictId;
        $this->selectedSubdistrictId = $subdistrictId;
        $row = $this->subdistrictRows[$subdistrictId] ?? null;
        $this->selectedSubdistrictName = $row['name'] ?? ($this->subdistrictList[$subdistrictId] ?? '');
        $this->selectedPostalCode = $row['zip_code'] ?? $this->selectedPostalCode;
    }

    public function render()
    {
        return view('bootstrap.livewire.region', [
            'province' => CekOngkir::getProvinces()->all(),
        ]);
    }
}
