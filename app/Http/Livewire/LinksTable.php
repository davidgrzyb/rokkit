<?php

namespace App\Http\Livewire;

use App\Link;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class LinksTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $domain = '';
    public $sortField = '';
    public $sortOrder = 'desc';
    public $search = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.links-table', [
            'links' => Link::search($this->search)
                ->when($this->domain != '', function ($query) {
                    $query->whereHas('domain', function ($query) {
                        $query->where('name', $this->domain);
                    });
                })
                ->withCount([
                    'clicks',
                    'redirects',
                ])
                ->orderBy(
                    $this->sortField == '' ? 'created_at' : $this->sortField,
                    $this->sortOrder
                )->paginate($this->perPage),
        ]);
    }
}
