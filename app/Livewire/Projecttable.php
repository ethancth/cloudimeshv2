<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Projecttable extends Component
{

  use WithPagination;
    public function render()
    {
      return view('livewire.projecttable',[
        'projects'=>Project::paginate(50)
      ]);
    }
}
