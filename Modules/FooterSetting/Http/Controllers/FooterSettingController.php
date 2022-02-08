<?php

namespace Modules\FooterSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\FooterSettingService;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    protected $service;

    public function __construct(FooterSettingService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('footersetting::index', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $stored = $this->service->insertFooterSetting($request->all());
            if($stored) {
                session()->flash('success', [
                    'Product has been created sucessfully'
                ]);
            }
            return redirect()->back();
        } catch (LadminException $e) {
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }
}
