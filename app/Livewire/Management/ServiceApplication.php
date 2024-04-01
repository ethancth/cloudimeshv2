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
    public $add_btn_title='Add Service Application',$canvas_title='New Record',$set_display_name='Service Application',$edit_id;


    public  $name,$display_name, $status, $description,$cost,$_is_one_time_payment,$is_cost_per_core,$cpu_amount;

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


    public function click_add(){
        $this->canvas_title = 'New Record';
    }

    public function edit($id){
        $this->resetValidation();

        $record=ModelServiceApplication::where('id','=',$id)->first();
        $this->edit_id=$record->id;

        $this->canvas_title = 'Edit Record';

        $this->name=$record->name;
        $this->display_name=$record->display_name;
        $this->cost=$record->cost;
        $this->status=$record->status;
    }


    public function store()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|max:100|min:5|unique:service_applications,name,'.$this->edit_id.',id,tenant_id,'.Auth::user()->current_team_id,
            'display_name' => 'required|max:100|min:5',
            'cost' => 'required|numeric|max:9999|min:0',
            'status' => 'required|in:0,1',
        ],

            [
                'name.required' => 'The '.$this->set_display_name.' name field is required.',
                'status.required' => 'The publish selected option is required.',
                'name.min' => $this->set_display_name.' Name Should be Minimum of 5 Character.',
                'name.max' => $this->set_display_name.' Name Must not be greater than 100 characters.',
                'name.unique' => $this->set_display_name.' Name has already been taken.'
            ]
        );



        $record=ModelServiceApplication::updateOrCreate(
            [
                'id' => $this->edit_id,
            ],
            [
                'name' => $this->name,
                'display_name' => $this->display_name,
                'display_description' => $this->display_name,
                'cost' => $this->cost,
                'is_one_time_payment' => '1',
                'status' => $this->status,
                'tenant_id' =>  Auth::user()->current_team_id,
                'updated_by' =>Auth::id(),

            ]
        );
        if($this->edit_id){
            $_store_status='Updated';
        }else{
            $_store_status='Created';
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
