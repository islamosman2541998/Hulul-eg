<?php

use App\Models\Pages;
use App\Models\Settings;


if (!function_exists('SETTING_SITE')) {
    function SETTING_SITE($key = false){
        $setting = @Settings::query()->where('key', 'site_setting')->get()->first();
        if($setting != null){
            return  @$setting->values->where('key', $key)->first()->value;
        }
        else return "";
    }
}


if (!function_exists('MULTIPLE_SETTING_SITE')) {
    function MULTIPLE_SETTING_SITE($arr_key = false){
        $setting = @Settings::query()->where('key', 'site_setting')->get()->first();
        if($setting != null){
            return  @$setting->values->whereIn('key', $arr_key)->pluck('value' , 'key' );
        }
        else return "";
    }
}



if (!function_exists('getPages')) {
    function getPages($id = null) {
        if($id == ''){
            $pages = @Pages::query()->with('trans')->where('id','>',1)->Active()->get();
        }
        else{
            $pages = @Pages::query()->with('trans')->whereId($id)->first();
        }
        return $pages ;
    }
}


if (! function_exists('alternate_url')) {
    /**
     * This page in another language, for the language switcher. Pages whose slug differs per
     * language (services, articles) share the exact URLs as `seoAlternates`, so the switcher
     * lands on the page itself instead of a slug from the other language that redirects.
     */
    function alternate_url(string $locale): string
    {
        $alternates = \Illuminate\Support\Facades\View::shared('seoAlternates') ?: [];

        return $alternates[$locale]
            ?? \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($locale);
    }
}


if (! function_exists('webp_asset')) {
    /**
     * asset() for an uploaded image, served as the lighter WebP copy when `php artisan
     * images:webp` has made one (photo.jpg -> photo.webp next to it). Anything else, or an image
     * without a copy yet, gets the usual asset() URL.
     */
    function webp_asset(?string $path): string
    {
        return asset(\App\Support\Images::webp((string) $path));
    }
}
