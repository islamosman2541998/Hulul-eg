<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Portfolios;
use App\Models\PortfolioTags;

class PortfolioGallery extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; 

    public $activeTag = 'all';          
    public $perPage = 9;                

    public function mount()
    {
        
    }

    public function filterByTag($tagSlug)
    {
        $this->activeTag = $tagSlug;
        $this->resetPage(); 
    }

    public function render()
    {
        $query = Portfolios::active()
    ->with(['tag.transNow', 'transNow']) 
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