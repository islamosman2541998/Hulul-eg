<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolios;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Models\PortfolioTags;
use App\Models\Tag;
use App\Models\Gallery;
use App\Models\GalleryGroup;
use App\Traits\FileHandler;

class PortfolioController extends Controller
{
    use FileHandler;
    public $tags;



    public $galleryPath;

    public function __construct()
    {
        $this->tags = PortfolioTags::query()->with('trans')->get();
        $this->galleryPath = "/attachments/gallery/portfolios/";
    }

    public function index(Request $request)
    {

        $query = Portfolios::query()->with('trans', 'tag')->orderBy('id', 'ASC');
        $tags = $this->tags;

        if ($request->status  != '') {
            if ($request->status == 1) $query->where('status', $request->status);
            else {
                $query->where('status', '!=', 1);
            }
        }
        if ($request->title  != '') {
            $query = $query->orWhereTranslationLike('title', '%' . request()->input('title') . '%');
        }

        if ($request->tag_id != '') {
            $query = $query->where('tag_id',  request()->input('tag_id'));
        }

        $items = $query->paginate($this->pagination_count);
        return view('admin.dashboard.portfolio.index', compact('items', 'tags'));
    }

    public function create()
    {
        $tags = $this->tags;
        return view('admin.dashboard.portfolio.create', compact('tags'));
    }


  public function store(PortfolioRequest $request)
{
    $data = $request->getSanitized();

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $mime = $file->getMimeType();

        if (str_starts_with($mime, 'image/')) {
            $mediaType = 'image';
        } elseif (str_starts_with($mime, 'video/')) {
            $mediaType = 'video';
        } elseif ($mime === 'application/pdf' || $ext === 'pdf') {
            $mediaType = 'pdf';
        } else {
            $mediaType = 'other';
        }

        $data['image'] = $this->upload_file($request->file('image'), 'portfolio');
        $data['type'] = $mediaType;
    }

    $portfolio = Portfolios::create($data);

    if ($request->hasFile('gallery_image')) {
        if ($portfolio->galleryGroup) {
            $group = $portfolio->galleryGroup;
        } else {
            $group = GalleryGroup::create([
                'type' => 2,
                'status' => 1,
                'foreign_key' => $portfolio->id,
                'created_by' => auth()->id(),
            ])->refresh();
        }

        if ($request->has('gallery')) {
            $group->update($request->gallery);
        }

        $allImages = $this->storeImageMulti(
            $request,
            $this->galleryPath,
            $request->gallery_image,
            'gallery_image'
        );

        $imgArr = [];

        foreach ($request->gallery_image as $keyImg => $valImg) {
            $imgArr[] = new Gallery([
                'image' => $allImages[$keyImg] ?? '',
                'sort' => $request->gallery_sort[$keyImg] ?? 0,
                'gallery_group_id' => $group->id,
                'feature' => isset($request->gallery_feature[$keyImg]) ? 1 : 0,
                'status' => 1,
                'created_by' => auth()->id(),
            ]);
        }

        $group->images()->saveMany($imgArr);
    }

    session()->flash('success', trans('message.admin.created_sucessfully'));

    return redirect()->route('admin.portfolio.edit', $portfolio->id);
}


    public function show(Portfolios $portfolio)
    {


        return view('admin.dashboard.portfolio.show', compact('portfolio'));
    }


    public function edit(Portfolios $portfolio)
    {
        $tags = $this->tags;
        return view('admin.dashboard.portfolio.edit', compact('portfolio', 'tags'));
    }


    public function update(PortfolioRequest $request, Portfolios $portfolio)
    {
        $data = $request->getSanitized();

        if ($request->hasFile('image')) {
            @unlink($portfolio->image);

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $mime = $file->getMimeType();

            if (str_starts_with($mime, 'image/')) {
                $mediaType = 'image';
            } elseif (str_starts_with($mime, 'video/')) {
                $mediaType = 'video';
            } elseif ($mime === 'application/pdf' || $ext === 'pdf') {
                $mediaType = 'pdf';
            } else {
                $mediaType = 'other';
            }

            $data['image'] = $this->upload_file($request->file('image'), 'portfolio');
            $data['type'] = $mediaType;
        }

        $portfolio->update($data);

        if ($request->hasFile('gallery_image')) {
            if ($portfolio->galleryGroup) {
                $group = $portfolio->galleryGroup;
            } else {
                $group = GalleryGroup::create([
                    'type' => 2,
                    'status' => 1,
                    'foreign_key' => $portfolio->id,
                    'created_by' => auth()->id(),
                ])->refresh();
            }

            if ($request->has('gallery')) {
                $group->update($request->gallery);
            }

            $allImages = $this->storeImageMulti(
                $request,
                $this->galleryPath,
                $request->gallery_image,
                'gallery_image'
            );

            $imgArr = [];

            foreach ($request->gallery_image as $keyImg => $valImg) {
                $imgArr[] = new Gallery([
                    'image' => $allImages[$keyImg] ?? '',
                    'sort' => $request->gallery_sort[$keyImg] ?? 0,
                    'gallery_group_id' => $group->id,
                    'feature' => isset($request->gallery_feature[$keyImg]) ? 1 : 0,
                    'status' => 1,
                    'created_by' => auth()->id(),
                ]);
            }

            $group->images()->saveMany($imgArr);
        }

        session()->flash('success', trans('message.admin.updated_sucessfully'));
        return redirect()->back();
    }


    public function destroy(Portfolios $portfolio)
    {
        @unlink($portfolio->image);
        $portfolio->delete();
        session()->flash('success', trans('message.admin.deleted_sucessfully'));
        return redirect()->back();
    }

    public function destroyImage($id)
    {
        $image = Gallery::findOrFail($id);

        $filePath = public_path($image->pathInView('portfolios'));

        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $image->delete();

        session()->flash('success', trans('message.admin.deleted_sucessfully'));
        return redirect()->back();
    }
    public function update_status($id)
    {
        $portfolio = Portfolios::findOrfail($id);
        $portfolio->status == 1 ? $portfolio->status = 0 : $portfolio->status = 1;
        $portfolio->save();
        return redirect()->back();
    }

    public function update_featured($id)
    {
        $portfolio = Portfolios::findOrfail($id);
        $portfolio->feature == 1 ? $portfolio->feature = 0 : $portfolio->feature = 1;
        $portfolio->save();
        return redirect()->back();
    }



    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $portfolios = Portfolios::findMany($request['record']);
            foreach ($portfolios as $portfolio) {
                $portfolio->update(['status' => 1]);
            }
            session()->flash('success', trans('portfolio.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $portfolios = Portfolios::findMany($request['record']);
            foreach ($portfolios as $portfolio) {
                $portfolio->update(['status' => 0]);
            }
            session()->flash('success', trans('portfolio.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $portfolios = Portfolios::findMany($request['record']);
            foreach ($portfolios as $portfolio) {
                @unlink($portfolio->image);
                $portfolio->delete();
            }
            session()->flash('success', trans('pages.delete_all_sucessfully'));
        }
        return redirect()->back();
    }
}
