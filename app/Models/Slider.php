<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory, SoftDeletes;
    use Translatable;
    public $translatedAttributes = ['title','slug','description','slider_id','locale',];
    protected $fillable = [
        'url',
        'sort',
        'image',
        'video',
        'status',
        'created_by',
        'updated_by',
    ];


    /******************boot model*******************/



    protected static function boot()
    {
        parent::boot();

        // Apply the relationship globally
        static::addGlobalScope('transNow', function (Builder $builder) {
            $builder->with('transNow');
        });
    }

    /******************end boot model**********************/






    protected $translationForeignKey = 'slider_id';
    public function trans()
    {
        return $this->hasMany(SliderTranslation::class, 'slider_id', 'id');
    }

    public function transNow()
    {
        return $this->hasOne(SliderTranslation::class, 'slider_id')->where('locale' , app()->getLocale());
    }






    // Scopes ---------------------------------------------------------------------------------
    public function scopeActive($query){
        return $query->where('status', 1);
    }




    /*******************images part ********************/

    //path of images
    public function path()
    {
        $path = "/attachments/slider/";
        return $path;
    }
    public function pathvideo()
    {
        $path = "storage/attachments/slider/";
        return $path;
    }




    //path of images that showed in view
    public function pathInView()
    {
        if(file_exists(public_path() . $this->path() . $this->image)   && $this->image){
            $path =   $this->path() . $this->image;
        }else{
            $path = '/attachments/no_image/no_image.png';
        }
        return $path;
    }

 public function videoInView()
    {
        if ($this->video && file_exists(public_path($this->pathvideo() . $this->video))) {
            return $this->pathvideo() . $this->video;
        }
        return null; 
    }



}
