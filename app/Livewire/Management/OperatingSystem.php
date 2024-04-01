<?php

namespace App\Livewire\Management;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\OperatingSystem as ModelClass;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OperatingSystem extends Component
{
    public function render()
    {

        return view('livewire.management.operating-system', [
            'datas' => \App\Models\OperatingSystem::search($this->search)
                ->where('tenant_id', '=', Auth::user()->current_team_id)
                ->orderBy($this->sortBy, $this->sortDir)
                ->Paginate($this->perPage)
        ]);
    }

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];

    //for view
    public $add_btn_title='Add ',$canvas_title='New Record',$set_display_name='Operating System',$edit_id,$canvas_btn_title='Create';

    //model
    public  $name,$display_name, $status, $display_description,$display_icon,$display_icon_colour,$cost,$os_type;

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


        $data=ModelClass::where('id','=',$id)->first();
        $data->delete();

//    $this->flash('success', 'Successfully Delete Project '.$project->title );
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Delete '.$this->set_display_name,
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

    public function click_add(){
        $this->canvas_title = 'New Record';
        $this->canvas_btn_title='Create';
    }

    public function edit($id){
        $this->resetValidation();

        $record=ModelClass::where('id','=',$id)->first();
        $this->edit_id=$record->id;

        $this->canvas_title = 'Edit Record';
        $this->canvas_btn_title='Saved';

        $this->name=$record->name;
        $this->display_name=$record->display_name;
        $this->display_description=$record->display_description;
        $this->os_type=$record->os_type;
        $this->cost=$record->cost;
        $this->status=$record->status;
    }
    public function store()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|max:100|min:5|unique:environments,name,'.$this->edit_id.',id,tenant_id,'.Auth::user()->current_team_id,
            'display_description' => 'required|max:100|min:5',
            'display_name' => 'required|max:100|min:5',
            'cost' => 'required|numeric|max:9999|min:0',
            'status' => 'required|in:0,1',
            'os_type' => 'required|in:windows,rhel,centos,other',
        ],

            [
                'name.required' => 'The '.$this->set_display_name.' name field is required.',
                'status.required' => 'The publish selected option is required.',
                'name.min' => $this->set_display_name.' Name Should be Minimum of 5 Character.',
                'name.max' => $this->set_display_name.' Name Must not be greater than 100 characters.',
                'name.unique' => $this->set_display_name.' Name has already been taken.'
            ]
        );

        //Add Data into Post table Data
        $record=ModelClass::updateOrCreate(
            [
                'id' => $this->edit_id,
            ],
            [
                'name' => $this->name,
                'display_name' => $this->display_name,
                'display_description' => $this->display_description,
                'display_icon' => $this->os_type,
                'display_icon_colour' => $this->os_type,
                'cost' => $this->cost,
                'os_type' => $this->os_type,
                'status' => $this->status,
                'tenant_id' =>  Auth::user()->current_team_id,
                'updated_by' =>Auth::id(),

            ]
        );

        if($this->edit_id){
            $_store_status='Updated';
        }else{
            $_store_status='Update';
        }

        $this->dispatch('close-canvas');
        $this->title = '';

        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully '.$_store_status.' '.$this->set_display_name,
            'text'=>$record->name,
        ]);



        $this->id = '';
        $this->edit_id = '';
        $this->resetValidation();



    }
}
