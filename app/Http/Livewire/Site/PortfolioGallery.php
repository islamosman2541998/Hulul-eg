<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Portfolios;
use App\Models\PortfolioTags;

class PortfolioGallery extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // أو tailwind حسب الـ theme بتاعك

    public $activeTag = 'all';          // 'all' أو tag slug
    public $perPage = 9;                // عدد العناصر في الصفحة (3×3 grid)

    public function mount()
    {
        // لو جاي slug في الـ URL (اختياري لو عايز /portfolio/branding)
        // $this->activeTag = request()->segment(2) ?? 'all';
    }

    public function filterByTag($tagSlug)
    {
        $this->activeTag = $tagSlug;
        $this->resetPage(); // مهم: رجّع للصفحة 1 بعد تغيير الفلتر
    }

    public function render()
    {
        $query = Portfolios::active()
    ->with(['tag.transNow', 'transNow']) // Add transNow here
    ->orderBy('sort', 'ASC')
    ->orderBy('id', 'DESC');
            $tags = PortfolioTags::active()
    ->with(['trans' => function ($q) {
        $q->where('locale', app()->getLocale());
    }])
    ->orderBy('sort')
    ->get();

        $query = Portfolios::active()
            ->with(['tag.transNow', 'trans'])
            ->orderBy('sort', 'ASC')
            ->orderBy('id', 'DESC');

        if ($this->activeTag !== 'all') {
            $tag = PortfolioTags::whereHas('trans', function ($q) {
                $q->where('slug', $this->activeTag);
            })->first();

            if ($tag) {
                $query->where('tag_id', $tag->id);
            }
        }

        $portfolios = $query->paginate($this->perPage);

        return view('livewire.site.portfolio-gallery', [
            'tags'       => $tags,
            'portfolios' => $portfolios,
        ]);
    }
}