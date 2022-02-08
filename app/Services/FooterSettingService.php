<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FooterSettingService {
    public function insertFooterSetting($data){
        // my data storage location is project_root/storage/app/data.json file.
        $contactInfo = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        $inputData = $data;
        $inputData['datetime_submitted'] = date('Y-m-d H:i:s');
        $contactInfo = $inputData;
        Storage::disk('local')->put('footer-setting.json', json_encode($contactInfo));
        return $inputData;
    }
}
