<?php

namespace App\Http\Livewire;

use App\Domain;
use Livewire\Component;
use Livewire\WithPagination;

class DomainsTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';

    public function render()
    {
        return view('livewire.domains-table', [
            'domains' => Domain::search($this->search)
                ->where('user_id', auth()->user()->id)
                ->orderByDesc('created_at')
                ->paginate($this->perPage),
        ]);
    }
}
