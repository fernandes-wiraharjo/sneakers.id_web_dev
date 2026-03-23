<?php

namespace Modules\GlobalSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GlobalSetting\Repositories\GlobalSettingRepository;
use Modules\GlobalSetting\Entities\GlobalSettingDatatables;
use GuzzleHttp\Psr7\UploadedFile;
use Hexters\Ladmin\Exceptions\LadminException;
use Modules\GlobalSetting\Entities\GlobalSetting;
use Alert;
use App\DataTables\GlobalSettingDatatables as DataTablesGlobalSettingDatatables;

class GlobalSettingController extends Controller
{

    protected $repository;

    public function __construct(GlobalSettingRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(GlobalSettingDatatables $dataTables)
    {
        ladmin()->allow('administrator.master-data.global-setting.index');

        return $dataTables->render('globalsetting::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        ladmin()->allow('administrator.master-data.global-setting.create');
        $data['setting'] = new GlobalSetting();

        return view('globalsetting::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'setting_type' => 'required|max:255',
                'setting_code' => 'required|unique:global_settings|max:255',
                'image' => 'required|image',
            ]);

            if($validator) {
                $stored = $this->repository->createGlobalSetting($request);
                if($stored){
                    Alert::success('Global Setting Created Successfully!');
                    return redirect(route('administrator.master-data.global-setting.index'))
                        ->with('success', 'Global Setting Created Successfully!');
                } else {
                    Alert::error('Failed to created global setting, check your info!');
                    return redirect()->back();
                }
            } else {
                Alert::error('Failed to created global setting, check your info!');
                return redirect()->back();
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('globalsetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.global-setting.update');
        $data['setting'] = $this->repository->getGlobalSettingById($id);
        return view('globalsetting::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $old_data = $this->repository->getGlobalSettingById($id);
            $data = $request->all();

            if($old_data->setting_code == $data['setting_code']){
                $validation = [
                    'setting_type' => 'required|max:255',
                    'setting_code' => 'required|exists:global_settings,setting_code|max:255',
                    'image' => 'image',
                ];
            } else {
                $validation = [
                    'setting_type' => 'required|max:255',
                    'setting_code' => 'required|unique:global_settings,setting_code|max:255',
                    'image' => 'image',
                    // 'is_menu' => 'brandmenu'
                ];
            }

            $message = [
                //'is_menu.brandmenu' => 'Brand menu cannot more than 3 actived!',
                'image.dimensions' => 'Brand image must be more than 500p, below 1500p and aspect ratio 1:1!'
            ];

            $validator = $request->validate($validation, $message);

            if($validator) {
                $updated = $this->repository->updateGlobalSetting($request, $id);
                if($updated){
                    Alert::success('Global Setting Updated Successfully!');
                    return redirect(route('administrator.master-data.global-setting.index'))
                        ->with('success', 'Global Setting Updated Successfully!');
                } else {
                    Alert::error('Failed to updated global setting, check your info!');
                    return redirect()->back();
                }
            }
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->repository->deleteGlobalSetting($id);

            if($deleted){
                Alert::success('Global Setting Deleted Successfully!');
                return redirect(route('administrator.master-data.global-setting.index'))
                    ->with('success', 'Global Setting Deleted Successfully!');
            } else {
                Alert::error('Failed to delete global setting, check your info!');
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
