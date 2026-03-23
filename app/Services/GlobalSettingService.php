<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSettingService {
	public function insertGlobalSetting($request){
		$data = $request->all();

        if (isset($data['image'])) {
            $path = 'images/global-setting';
            $do_upload = uploadAsWebp($data['image'], $path ,'public', 1200, 1200, Str::slug($data['setting_code']), 'resize');
            $data['setting_value'] = $do_upload;
        }

        foreach ($data as $key => $value){ $global_setting[$key] = $value; }
        return $global_setting;
	}

    public function updateGlobalSetting($request){
        $data = $request->all();

        $path = 'images/global-setting';
        if(isset($data['image'])) {
            $do_upload = uploadAsWebp($data['image'], $path, 'public', 1200, 1200, Str::slug($data['setting_code']), 'resize');
            $data['setting_value'] = $do_upload;
        }

        foreach ($data as $key => $value) { $global_setting[$key] = $value; }
        return $global_setting;
    }
}
