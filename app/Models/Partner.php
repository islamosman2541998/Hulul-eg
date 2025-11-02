<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use Translatable, SoftDeletes;

    protected $fillable = [
        'image', 'url', 'status', 'sort', 'created_by', 'updated_by'
    ];

    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'partner_id';

    // helper paths
    public function path() { return '/attachments/partners/'; }

    public function pathInView()
    {
        if ($this->image && file_exists(public_path($this->path() . $this->image))) {
            return $this->path() . $this->image;
        }
        return '/attachments/no_image/no_image.png';
    }
}
