<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
        'slug',
        'title',
        'short_description',
        'description',
        'requirements',
        'seo_title',
        'seo_description',
        'meta_key',
        'meta_desc',
        'meta_title'

    ];

    protected $fillable = [

        'employment_type',
        'location',
        'image',
        'status',
        'feature',
        'sort',
        'created_by',
        'updated_by'
    ];

    public function cvs()
    {
        return $this->hasMany(Cv::class);
    }


    public function trans()
    {
        return $this->hasMany(JobTranslation::class, 'job_id');
    }

    public function transNow()
    {
        return $this->hasOne(JobTranslation::class, 'job_id')->where('locale', app()->getLocale());
    }

    // Scopes ----------------------------
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
