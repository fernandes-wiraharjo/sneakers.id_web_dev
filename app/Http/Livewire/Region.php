<?php

namespace App\Http\Livewire;

use App\Models\Region as ModelRegion;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Region extends Component
{
    public $district;
    public $subdistrict;
    public $area;
    public $postalCode;
    public $selectedProvince;
    public $selectedDistrict;
    public $selectedSubdistrict;
    public $selectedArea;
    public $selectedPostalCode;
    public $userRegion;

    public function mount($user_region = null, $province = null) {
        $this->district = [];
        $this->subdistrict = [];
        $this->area = [];
        $this->postalCode = [];
        $this->selectedDistrict = '';
        $this->selectedSubdistrict = '';
        $this->selectedArea = '';
        $this->selectedPostalCode = '';
        
        // Use passed user_region or get from auth user
        if ($user_region) {
            $this->userRegion = $user_region;
        } else {
            $this->userRegion = ModelRegion::where('region_id', auth()->user()->user_address->region_id ?? '')->first();
        }
        
        // Initialize with user's existing region data if available
        if ($this->userRegion) {
            $this->selectedProvince = $this->userRegion->province;
            $this->selectedDistrict = $this->userRegion->district;
            $this->selectedSubdistrict = $this->userRegion->subdistrict;
            $this->selectedArea = $this->userRegion->region_id;
            $this->selectedPostalCode = $this->userRegion->post_code;
            
            // Load initial data
            $this->district = ModelRegion::selectRaw('DISTINCT(district)')->where('province', $this->selectedProvince)->where('subdistrict_ro', '<>', 'NULL')->get()->pluck('district');
            $this->subdistrict = ModelRegion::selectRaw('DISTINCT(subdistrict)')->where('district', $this->selectedDistrict)->where('area', '<>','-')->get()->pluck('subdistrict');
            $this->area = ModelRegion::where('subdistrict', $this->selectedSubdistrict)->get()->pluck('area','region_id');
            $this->postalCode = ModelRegion::selectRaw('DISTINCT(post_code)')->where('subdistrict', $this->selectedSubdistrict)->orderBy('post_code')->get()->pluck('post_code');
        }
    }

    public function updateDistrict($value) {
        $this->selectedProvince = $value;
        $this->district = ModelRegion::selectRaw('DISTINCT(district)')->where('province', $value)->where('subdistrict_ro', '<>', 'NULL')->get()->pluck('district');
        
        // Reset dependent fields
        $this->selectedDistrict = '';
        $this->selectedSubdistrict = '';
        $this->selectedArea = '';
        $this->selectedPostalCode = '';
        $this->subdistrict = [];
        $this->area = [];
        $this->postalCode = [];
    }

    public function updateSubdistrict($value) {
        $this->selectedDistrict = $value;
        $this->subdistrict = ModelRegion::selectRaw('DISTINCT(subdistrict)')->where('district', $value)->where('area', '<>','-')->get()->pluck('subdistrict');
        
        // Reset dependent fields
        $this->selectedSubdistrict = '';
        $this->selectedArea = '';
        $this->selectedPostalCode = '';
        $this->area = [];
        $this->postalCode = [];
    }

    public function updateArea($value) {
        $this->selectedSubdistrict = $value;
        $this->area = ModelRegion::where('subdistrict', $value)->get()->pluck('area','region_id');
        $this->postalCode = ModelRegion::selectRaw('DISTINCT(post_code)')->where('subdistrict', $value)->orderBy('post_code')->get()->pluck('post_code');
        
        // Reset dependent fields
        $this->selectedArea = '';
        $this->selectedPostalCode = '';
    }

    public function areaUpdate($value) {
        $regionData = ModelRegion::where('region_id', $value)->first();
        if ($regionData) {
            $this->selectedArea = $value;
            $this->selectedPostalCode = $regionData->post_code;
        }
    }

    public function updateZipCode($value) {
        $this->selectedPostalCode = $value;
        $regionData = ModelRegion::where('post_code', $value)->first();
        if ($regionData) {
            $this->selectedArea = $regionData->region_id;
        }
    }

    public function render()
    {
        $province = ModelRegion::selectRaw('DISTINCT(province)')->orderBy('province')->get()->pluck('province');
        return view('bootstrap.livewire.region', compact('province'));
    }
}
