<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DepartmentList extends Component
{


    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];

    public $selectedhod=[];
    public $selectedmember=[];

    public  $name, $status, $description ,$add_btn_title= 'Create New Department';

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


        $record=Department::where('id','=',$id)->first();
        $record->delete();


//    $this->alert('success', 'Successfully Create Project');
        $this->dispatch('close-modal');
        $this->name = '';
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Department Deleted Successfully',
            'text'=>'',
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




    public function storeDepartment()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|max:100|min:5|unique:departments,name,NULL,id,tenant_id,'  . auth()->id(),
//            'selectedhod' => 'required',
            'selectedmember' => 'required',
        ],

            [
                'name.required' => 'The Department name field is required.',
                'name.min' => 'Department Name Should be Minimum of 5 Character.',
                'name.max' => 'Department Name Must not be greater than 100 characters.',
                'name.unique' => 'Department Name has already been taken.',
//                'selectedhod.required' => 'The HOD field is required.',
                'selectedmember.required' => 'The Member field is required.',

            ]
        );
        //Add Data into Post table Data
        $record = new Department();
        $record->name = $this->name;
        $record->default = 0;
        $record->tenant_id=Auth::user()->current_team_id;
        $record->save();
        $this->dispatch('close-modal');
        $this->name = '';
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Department Created Successfully',
            'text'=>'',
        ]);

    }
    #[Layout('content.app')]
    public function render()
    {

        $team=Team::find(Auth::user()->current_team_id);


        return view('livewire.department.department-list',
            [
                'teams' => $team->allUsers(),
                'departments' => Department::search($this->search)
                    ->where('tenant_id','=',Auth::user()->current_team_id)
                    ->orderBy($this->sortBy,$this->sortDir)
                    ->Paginate($this->perPage)
            ]
        )->layout('content.app');;
    }

}
