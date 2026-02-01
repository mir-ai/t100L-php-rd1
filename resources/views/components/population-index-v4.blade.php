<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\ControllerSupports\PopulationCs;

/**
 * 人口の最新データを自動的に画面に反映する
 */
new class extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public array $conds;
  
    public function mount(array $conds)
    {
        $this->conds = $conds;
    }

    public function render()
    {
        $conds = $this->conds;
        $populationCs = new PopulationCs();

        $populations = $populationCs->getSearch(
            conds: $conds,
            addConds: [
            ]
        );

        return view('components.population-index-v4', compact(
            'populations',
            'conds',
        ));
    }
};
?>

<div wire:poll.5s>

  {{-- Livewire で一覧表示を行う。 --}}

  {{-- Pagination --}}
  <div class="row d-flex justify-content-center">
    <div class="col col-auto">
      {{ $populations->links(data: ['scrollTo' => false]) }}
    </div>
  </div>

  @include('v4.populations._index', ['conds' => $conds, 'is_livewire' => true])

  {{-- Pagination --}}
  <div class="row d-flex justify-content-center">
    <div class="col col-auto">
      {{ $populations->links(data: ['scrollTo' => false]) }}
    </div>
  </div>

</div>
