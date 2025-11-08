<?php

namespace App\Http\Requests\Admin;

use Locale;
use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        $attr = [];
        foreach (config('translatable.locales') as $locale) {
            $attr += [$locale . '.title' => 'Title ' . Locale::getDisplayName($locale)];
            $attr += [$locale . '.slug' => 'Slug ' . Locale::getDisplayName($locale)];
            $attr += [$locale . '.description' => 'Description ' . Locale::getDisplayName($locale)];
            $attr += [$locale . '.content' => 'Content ' . Locale::getDisplayName($locale)];
            $attr += [$locale . '.meta_title' => 'Meta title ' . Locale::getDisplayName($locale)];
            $attr += [$locale . '.meta_description' => 'Meta description ' . Locale::getDisplayName($locale)];
            $attr += [$locale . '.meta_key' => 'Meta key ' . Locale::getDisplayName($locale)];
        }
        $attr += ['tag_id' => 'Tag'];
        $attr += ['image' => 'Image'];
        $attr += ['sort' => 'Sort'];
        $attr += ['feature' => 'Fearure'];
        $attr += ['news_ticker' => 'News Ticker'];
        $attr += ['status' => 'Status'];
        return $attr;
    }

    public function rules()
    {
        $req = [];
        foreach (config('translatable.locales') as $locale) {
            $req += [$locale . '.title' => 'required'];
            $req += [$locale . '.description' => 'nullable'];
            $req += [$locale . '.content' => 'nullable'];

            $req += [$locale . '.meta_title' => 'nullable'];
            $req += [$locale . '.meta_description' => 'nullable'];
            $req += [$locale . '.meta_key' => 'nullable'];
        }
       $this->isMethod('POST') ?
    $req += ['image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,mkv,pdf|max:20480']
    :
    $req += ['image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,mov,avi,mkv,pdf|max:20480'];
        $req += ['tag_id' => 'required'];
        $req += ['link' => 'nullable'];
        $req += ['status' => 'nullable'];
        $req += ['type' => 'required|in:image,video,pdf'];
        $req += ['sort' => 'nullable'];
        $req += ['feature' => 'nullable'];
        $req += ['updated_by' => 'nullable'];
        $req += ['created_by' => 'nullable'];

        return $req;
    }

    public function getSanitized()
    {
        $data = $this->validated();
        foreach (config('translatable.locales') as $locale) {
            $data[$locale]['slug'] = slug($data[$locale]['title']);
        }
        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;

        if (request()->isMethod('PUT')) {
            $data['updated_by']  = @auth()->user()->id;
        } else {
            $data['created_by']  = @auth()->user()->id;
        }
        return $data;
    }
}
