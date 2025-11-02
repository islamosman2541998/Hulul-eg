<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\ServiceCategory;
use App\Models\GalleryGroup;
use App\Settings\SettingSingleton;
use App\Settings\HomeSettingSingleton;

use App\Models\Occasion;




use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ServiceCategoryController extends Controller


{

  
    public function showLandscapePage()
    {
        $landscapeCategory = ServiceCategory::with(['transNow', 'galleryGroup.images'])
        ->where('service_unique_name', 'landscape')
        ->first();
        
    $serviceCategory = ServiceCategory::with([
            'transNow',
            'galleryGroup.images',
            'followings.translations'   
        ])->where('service_unique_name', 'landscape')
          ->firstOrFail();

        $images   = $serviceCategory->galleryGroup
                       ? $serviceCategory->galleryGroup->images
                       : collect();

        $followings = $serviceCategory->followings;



        $settings = SettingSingleton::getInstance();
        $current_lang = app()->getLocale();




        return view('site.pages.ServiceCategory.landscape',
         compact('landscapeCategory',
          'images','settings','current_lang','followings'));
    }
    

    
    public function showEventPage()
    {
        $eventCategory = ServiceCategory::
        with('transNow'
            ,'galleryGroup.images', 'getFollowings.translations')
            ->where('service_unique_name', 'events')
            ->first();
            $settings = SettingSingleton::getInstance();
            $current_lang = app()->getLocale();

    // $occasion = Occasion::event()                  
    //     ->whereTranslation('title', 'Because Every Occasion Deserves to Be Unforgettable')     
    //     ->with([
    //         'trans',                               
    //         'transNow',                            
    //         'galleryGroup.images'                  
    //     ])
    //     ->firstOrFail();

  $occasion = Occasion::event()
    ->whereHas('trans', function($q) {
        $q->where('locale', app()->getLocale())
          ->where('title', 'Because Every Occasion Deserves to Be Unforgettable');
    })
    ->with([
        'trans',
        'transNow',
        'galleryGroup.images'
    ])
    ->first();

if (!$occasion) {
    return redirect()->route('site.home')->with('error', 'Event not found.'); // important
}
    $galleryImages = $occasion->galleryGroup
        ->flatMap(fn($group) => $group->images)    
        ->map(fn($image) => asset($image->pathInView('occasions')))
        ->toArray();

                $event_followings = $eventCategory->getFollowings;


    

        return view('site.pages.ServiceCategory.events',
         compact('eventCategory','settings','current_lang',
          'occasion', 'galleryImages', 'event_followings'));
    }
}
