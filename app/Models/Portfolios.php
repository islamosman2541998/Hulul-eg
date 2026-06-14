<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\GalleryGroup;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolios extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'tag_id',
        'image',
        'link',
        'sort',
        'status',
        'feature',
        'type',
        'created_by',
        'updated_by',
    ];
    protected $translationForeignKey = 'portfolio_id';
    public $translatedAttributes = [
        'portfolio_id',
        'locale',
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_key',
    ];


    // relations ---------------------------------------------------------------------------------
    public function trans()
    {
        return $this->hasMany(PortfoliosTranslation::class, 'portfolio_id', 'id');
    }
    public function tag()
    {
        return $this->belongsTo(PortfolioTags::class, 'tag_id')->with('trans');
    }
public function transNow()
{
    return $this->hasOne(PortfoliosTranslation::class, 'portfolio_id')
                ->where('locale', app()->getLocale());
}
    public function projects()
    {
        return $this->hasMany(Projects::class, 'portfolio_id', 'id')->with('trans');
    }

    public function projectsactive()
    {
        return $this->hasMany(Projects::class, 'portfolio_id', 'id')->with('trans', 'images')->active()->orderBy('sort', 'ASC');
    }


    // Scopes ---------------------------------------------------------------------------------
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeFeature($query)
    {
        return $query->where('feature', 1);
    }
    public function galleryGroup()
{
    return $this->hasOne(GalleryGroup::class, 'foreign_key')->where('type', 2);
}
public function getYoutubeIdAttribute()
{
    if (!$this->link) {
        return null;
    }

    $url = trim($this->link);

    // youtube.com/shorts/VIDEO_ID
    if (preg_match('/youtube\.com\/shorts\/([^?&\/]+)/', $url, $matches)) {
        return $matches[1];
    }

    // youtube.com/watch?v=VIDEO_ID
    if (preg_match('/youtube\.com\/watch\?v=([^?&]+)/', $url, $matches)) {
        return $matches[1];
    }

    // youtu.be/VIDEO_ID
    if (preg_match('/youtu\.be\/([^?&\/]+)/', $url, $matches)) {
        return $matches[1];
    }

    // youtube.com/embed/VIDEO_ID
    if (preg_match('/youtube\.com\/embed\/([^?&\/]+)/', $url, $matches)) {
        return $matches[1];
    }

    return null;
}

public function getYoutubeEmbedUrlAttribute()
{
    if (!$this->youtube_id) {
        return null;
    }

    return 'https://www.youtube.com/embed/' . $this->youtube_id;
}

public function getIsYoutubeVideoAttribute()
{
    return !empty($this->youtube_id);
}
public function path()
{
    return "/attachments/portfolio/";
}

public function pathInView()
{
    if (file_exists(public_path($this->image)) && $this->image) {
        return $this->image;
    }

    return '/attachments/no_image/no_image.png';
}
}
