<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Modules\GlobalSetting\Entities\GlobalSetting;

class GlobalSettingsCache
{
    public const LINK_TOGGLES_CACHE_KEY = 'global_settings.link_toggles';

    private const LINK_SETTING_CODES = [
        'tokopedia' => 'enable_tokopedia_link',
        'shopee' => 'enable_shopee_link',
        'tiktok' => 'enable_tiktok_link',
        'blibli' => 'enable_blibli_link',
        'whatsapp' => 'enable_whatsapp_link',
    ];

    public function getLinkToggles(): array
    {
        return Cache::rememberForever(self::LINK_TOGGLES_CACHE_KEY, function () {
            $settings = GlobalSetting::query()
                ->whereIn('setting_code', array_values(self::LINK_SETTING_CODES))
                ->get()
                ->keyBy('setting_code');

            $toggles = [];

            foreach (self::LINK_SETTING_CODES as $key => $code) {
                $toggles[$key] = $this->isToggleEnabled($settings->get($code));
            }

            return $toggles;
        });
    }

    public function isLinkEnabled(string $link): bool
    {
        $toggles = $this->getLinkToggles();

        return $toggles[$link] ?? true;
    }

    public static function forgetLinkToggles(): void
    {
        Cache::forget(self::LINK_TOGGLES_CACHE_KEY);
    }

    private function isToggleEnabled(?GlobalSetting $setting): bool
    {
        if (! $setting) {
            return true;
        }

        if (! (bool) $setting->is_active) {
            return false;
        }

        return in_array(strtolower(trim((string) $setting->setting_value)), ['1', 'true', 'yes', 'on'], true);
    }
}
