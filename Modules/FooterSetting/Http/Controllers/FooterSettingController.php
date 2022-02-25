<?php

namespace Modules\FooterSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\FooterSettingService;
use Illuminate\Support\Facades\Storage;
use Alert;

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
            if($stored){
                Alert::success('Footer Setting Updated Successfully!');
                return redirect(route('administrator.master-data.footer-setting.index'))
                    ->with('success', 'Footer Setting Updated Successfully!');
            } else {
                Alert::error('Failed to updated footer setting, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }
}
