<?php

namespace App\Livewire\Management;

use App\Models\Department;
use App\Models\ServiceApplication as ModelServiceApplication;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ServiceApplication extends Component
{

    #[Layout('content.app')]
    public function render()
    {

        return view('livewire.management.service-application',
            [
                'datas' => ModelServiceApplication::search($this->search)
                    ->where('tenant_id','=',Auth::user()->current_team_id)
                    ->orderBy($this->sortBy,$this->sortDir)
                    ->Paginate($this->perPage)
            ]
        )->layout('content.app');;
    }


    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];
    public $add_btn_title='Add Service Application';

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


        $project=ModelServiceApplication::where('id','=',$id)->first();
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




    public function store()
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
        $data = new ModelServiceApplication();
        $data->title = $this->title;
        $data->status = 1;
        $data->user_id=Auth::id();
        $data->tenant_id=Auth::user()->current_team_id;
        $data->save();
        $this->dispatch('closeModal');
//    $this->alert('success', 'Successfully Create Project');
        $this->title = '';
        //For hide modal after add posts success
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Delete Service Application',
            'text'=>$data->title,
        ]);



    }

}
