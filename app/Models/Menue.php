<?php

namespace App\Models;

use App\Enums\MenuPositionEnums;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menue extends Model
{
    use HasFactory,Translatable, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'position',
        'sort',
        'url',
        'type',
        'level',
        'dynamic_table',
        'dynamic_url',
        'status',
        'created_by',
        'updated_by',
    ];
    // foreign key
    protected $translationForeignKey = 'menue_id';
    // transatable table
    public $translatedAttributes = ['menue_id', 'locale', 'title', 'slug'];


    public function trans(){
        return $this->hasMany(MenueTranslation::class, 'menue_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(Menue::class,'parent_id', 'id');
    }
    public function children(){
        return $this->hasMany(Menue::class, 'parent_id', 'id')->orderBy('sort', 'ASC')->active();
    }

    /**
     * Where the item links to, without locale. Service items are saved as the old
     * /categories-services/{slug} path, which redirects twice (old path, then the English slug
     * to this language's slug); they link to the current language's service page directly.
     */
    public function path(): ?string
    {
        $path = $this->type === 'dynamic' ? $this->dynamic_url : $this->url;

        if ($path && preg_match('#^/?categories-services/([^/?]+)#u', $path, $match)) {
            $slug = rawurldecode($match[1]);

            return '/services/' . (self::localServiceSlugs()[$slug] ?? $slug);
        }

        return $path;
    }

    /** Every service slug (any language) mapped to the current language's slug for that service. */
    private static function localServiceSlugs(): array
    {
        static $slugs = [];
        $locale = app()->getLocale();

        if (! isset($slugs[$locale])) {
            $rows = ServiceCategoryTranslation::query()->whereNotNull('slug')->get(['service_cat_id', 'locale', 'slug']);
            $local = $rows->where('locale', $locale)->pluck('slug', 'service_cat_id');

            $slugs[$locale] = $rows
                ->filter(fn ($row) => isset($local[$row->service_cat_id]))
                ->mapWithKeys(fn ($row) => [$row->slug => $local[$row->service_cat_id]])
                ->all();
        }

        return $slugs[$locale];
    }



    // Scopes ------------------------------------------------
    public function scopeActive($query){
        return $query->where('status', 1);
    }
    public function scopeMain($query){
        return $query->where('position', MenuPositionEnums::MAIN);
    }
    public function scopeFooter($query){
        return $query->where('position', MenuPositionEnums::FOOTER);
    }
    public function scopeParent($query){
        return $query->where('parent_id', null);
    }

}
