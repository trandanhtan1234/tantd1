<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\models\users;

class Search extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search', [
            'users' => users::where('email', 'like','%'.$this->search.'%')->get(),
        ]);
        // $data['users'] = users::where('email', 'like','%'.$this->search.'%')->get();

        // return view('livewire.search', $data);
    }
}
