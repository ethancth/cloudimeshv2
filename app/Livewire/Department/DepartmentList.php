<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DepartmentList extends Component
{


    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];

    public  $name, $status, $description;

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

        $this->flash('success', 'Successfully Delete Department '.$record->title );

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
        ],

            [
                'name.required' => 'The Department name field is required.',
                'name.min' => 'Department Name Should be Minimum of 5 Character.',
                'name.max' => 'Department Name Must not be greater than 100 characters.',
                'name.unique' => 'Department Name has already been taken.'
            ]
        );
        //Add Data into Post table Data
        $post = new Department();
        $post->name = $this->name;
        $post->default = 0;
        $post->tenant_id=Auth::user()->current_team_id;
        $post->save();
        $this->flash('success', 'Successfully Create Department');
        $this->name = '';
        $this->dispatch('close-modal');

    }

    public function render()
    {
        return view('livewire.department.department-list',
            [
                'departments' => Department::search($this->search)
                    ->where('tenant_id','=',Auth::user()->current_team_id)
                    ->orderBy($this->sortBy,$this->sortDir)
                    ->Paginate($this->perPage)
            ]
        );
    }

}
