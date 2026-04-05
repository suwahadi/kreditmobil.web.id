<?php

namespace App\Livewire\CarDetail;

use Livewire\Component;

class SpecificationSection extends Component
{
    public $title;
    public $specifications = [];
    public $isExpanded = false;

    public function mount($title, $specifications = [], $isExpanded = false)
    {
        $this->title = $title;
        $this->specifications = $specifications;
        $this->isExpanded = $isExpanded;
    }

    public function toggle()
    {
        $this->isExpanded = !$this->isExpanded;
    }

    public function render()
    {
        return view('livewire.car-detail.specification-section');
    }
}
