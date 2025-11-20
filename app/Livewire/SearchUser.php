<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public $query = "";
    public function render()
    {
        $results = collect();
        if ($this->query !== "") $results = User::where("username", "like", "%".trim($this->query)."%")->get();
        return view('livewire.search-user', ['results' => $results]);
    }
}
