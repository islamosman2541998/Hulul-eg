<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'image',
        'image_background',
        'ceo_image',
        'status',
        'sort',
        'created_by',
        'updated_by'
    ];

 
    public $translatedAttributes = [
        'title',
        'subtitle',
        'description',
        'sub_description',
        'our_story_title',
        'our_story_description',
        'ceo_title',
        'ceo_description',
        'vision',
        'mission',
        'at_a_glance',
    ];

    protected $translationForeignKey = 'about_id';

  
    public function trans()
    {
        return $this->hasMany(AboutTranslation::class, 'about_id', 'id');
    }

    public function transNow()
    {
        return $this->hasOne(AboutTranslation::class, 'about_id')->where('locale', app()->getLocale());
    }

    
    public function path()
    {
        return '/attachments/abouts/';
    }

    public function imageInView()
    {
        if ($this->image && file_exists(public_path($this->path() . $this->image))) {
            return $this->path() . $this->image;
        }
        return '/attachments/no_image/no_image.png';
    }

    public function imageBackgroundInView()
    {
        if ($this->image_background && file_exists(public_path($this->path() . $this->image_background))) {
            return $this->path() . $this->image_background;
        }
        return null;
    }

    public function ceoImageInView()
    {
        if ($this->ceo_image && file_exists(public_path($this->path() . $this->ceo_image))) {
            return $this->path() . $this->ceo_image;
        }
        return null;
    }
}
