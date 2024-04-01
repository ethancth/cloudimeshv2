<?php

namespace App\Livewire\Management;

use App\Models\Environment as ModelEnvironment;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Environment extends Component
{
    #[Layout('content.app')]
    public function render()
    {
        return view('livewire.management.environment', [
            'datas' => ModelEnvironment::search($this->search)
                ->where('tenant_id', '=', Auth::user()->current_team_id)
                ->orderBy($this->sortBy, $this->sortDir)
                ->Paginate($this->perPage)
        ]);
    }

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];
    public $add_btn_title='Add Service Environment',$canvas_title='New Record';


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


        $data=ModelEnvironment::where('id','=',$id)->first();
        $data->delete();

//    $this->flash('success', 'Successfully Delete Project '.$project->title );
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Delete Envionment',
            'text'=>$data->title,
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

    public function edit($id){
        $record=ModelEnvironment::where('id','=',$id)->first();

        $this->edit_id=$record->id;
        $this->canvas_title = 'Edit Record';
//        dump($record);

        $this->name=$record->name;
        $this->is_default_department=$record->default;
        $this->canvas_title = 'New Record';
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
        $data = new ModelEnvironment();
        $data->name = $this->name;
        $data->display_name = $this->display_name;
        $data->display_description = $this->display_description;
        $data->display_icon = $this->display_icon;
        $data->display_icon_colour = $this->display_icon_colour;
        $data->status = 1;
        $data->updated_by=Auth::id();
        $data->tenant_id=Auth::user()->current_team_id;
        $data->save();
        $this->dispatch('closeModal');
//    $this->alert('success', 'Successfully Create Project');
        $this->title = '';
        //For hide modal after add posts success
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Create Envionment',
            'text'=>$data->title,
        ]);



    }
}
