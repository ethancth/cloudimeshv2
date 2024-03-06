<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Projecttable extends Component
{


  use WithPagination, WithoutUrlPagination, LivewireAlert;
  protected $paginationTheme = 'bootstrap';
  public  $title, $status, $description;

  #[Url(history:true)]
  public $search = '';

  #[Url(history:true)]
  public $admin = '';

  #[Url(history:true)]
  public $sortBy = 'created_at';

  #[Url(history:true)]
  public $sortDir = 'DESC';

  #[Url()]
  public $perPage = 5;


  public function updatedSearch(){
    $this->resetPage();
  }

  public function delete(Project $project){
    $project->delete();

    $this->flash('success', 'Successfully Delete Project '.$project->title );
  }

  public function setSortBy($sortByField){

    if($this->sortBy === $sortByField){
      $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
      return;
    }

    $this->sortBy = $sortByField;
    $this->sortDir = 'DESC';
  }



  public function storeProject()
  {
    //on form submit validation
    $this->validate([
      'title' => 'required|max:255|min:5',
    ]
      ,[
        'title.required' => 'The project name field is required.',
        'title.min' => 'Project Name Should be Minimum of 5 Character'
    ]
    );

    //Add Data into Post table Data
    $post = new Project();
    $post->title = $this->title;
    $post->status = 1;
    $post->user_id=Auth::id();
    $post->save();

    $this->flash('success', 'Successfully Create Project');
//    $this->alert('success', 'Successfully Create Project');
    $this->title = '';
    //For hide modal after add posts success
    $this->dispatch('close-modal');
  }

  public function render()
  {
    return view('livewire.project-table',
      [
        'projects' => Project::search($this->search)
//          ->when($this->admin !== '',function($query){
//            $query->where('is_admin',$this->admin);
//          })
            ->where('user_id','=',Auth::id())
          ->orderBy($this->sortBy,$this->sortDir)
          ->Paginate($this->perPage)
      ]
    );
  }
}
