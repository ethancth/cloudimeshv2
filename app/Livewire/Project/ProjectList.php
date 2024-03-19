<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProjectList extends Component
{

  use WithPagination, WithoutUrlPagination, LivewireAlert;
  protected $paginationTheme = 'bootstrap';
  protected $listeners = ['delete'];

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

  public function deleteConfirm($id){

    $this->dispatch('swal:confirm',[
      'type'=>'warning',
      'title'=>'Are you sure?',
      'text'=>'',
      'id'=>$id,
    ]);

  }
  public function delete($id){


    $project=Project::where('id','=',$id)->first();
    $project->delete();

//    $this->flash('success', 'Successfully Delete Project '.$project->title );
    $this->dispatch('swal:modal',[
      'type'=>'success',
      'title'=>'Successfully Delete Project',
      'text'=>$project->title,
    ]);
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
      'title' => 'required|max:100|min:5|unique:projects,title,NULL,id,user_id,'  . auth()->id(),
    ],

      [
        'title.required' => 'The project name field is required.',
        'title.min' => 'Project Name Should be Minimum of 5 Character.',
        'title.max' => 'Project Name Must not be greater than 100 characters.',
        'title.unique' => 'Project Name has already been taken.'
      ]
    );

    //Add Data into Post table Data
    $post = new Project();
    $post->title = $this->title;
    $post->status = 1;
    $post->user_id=Auth::id();
    $post->tenant_id=Auth::user()->current_team_id;
    $post->save();
      $this->dispatch('closeModal');
//    $this->alert('success', 'Successfully Create Project');
    $this->title = '';
    //For hide modal after add posts success
    $this->dispatch('swal:modal',[
      'type'=>'success',
      'title'=>'Successfully Delete Project',
      'text'=>$post->title,
    ]);



  }

  public function render()
  {
    return view('livewire.project.project-list',
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
