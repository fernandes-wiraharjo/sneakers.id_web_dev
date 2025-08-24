<?php

namespace App\Http\Livewire;

use App\Models\Region as ModelRegion;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Region extends Component
{
    // public $province;
    public $district;
    public $subdistrict;
    public $area;
    public $postalCode;
    public $selectedProvince;
    public $userRegion;

    public function mount() {
        $this->district = [];
        $this->subdistrict = [];
        $this->area = [];
        $this->postalCode = [];
        $this->userRegion = ModelRegion::where('region_id', auth()->user()->user_address->region_id ?? '')->first();
        // $this->province = ModelRegion::selectRaw('DISTINCT(province)')->orderBy('province')->get()->pluck('province');
        // $this->district = ModelRegion::where('province', $this->selectedProvince)->orderBy('district')->get()->pluck('district');
    }

    public function updateDistrict($value) {
        $this->district = ModelRegion::selectRaw('DISTINCT(district)')->where('province', $value)->get()->pluck('district');
    }

    public function updateSubdistrict($value) {
        $this->subdistrict = ModelRegion::selectRaw('DISTINCT(subdistrict)')->where('district', $value)->where('area', '<>','-')->get()->pluck('subdistrict');
    }

    public function updateArea($value) {
        $this->area = ModelRegion::where('subdistrict', $value)->get()->pluck('area','region_id');
        $this->postalCode = ModelRegion::selectRaw('DISTINCT(post_code)')->where('subdistrict', $value)->orderBy('post_code')->get()->pluck('post_code');
    }

    public function render()
    {
        $province = ModelRegion::selectRaw('DISTINCT(province)')->orderBy('province')->get()->pluck('province');
        return view('livewire.region', compact('province'));
    }
}
