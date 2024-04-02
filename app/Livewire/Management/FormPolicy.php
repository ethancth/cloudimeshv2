<?php

namespace App\Livewire\Management;

use App\Models\FormPolicy as ModelFormPolicy;
use App\Models\Environment as ModelEnvironment;
use App\Models\ServiceApplication;
use App\Models\Tier as ModelTier;
use App\Models\ServiceApplication as ModelServiceApplication;
use App\Models\OperatingSystem as ModelOS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class FormPolicy extends Component
{

    #[Layout('content.app')]
    public function render()
    {
        return view('livewire.management.form-policy',[
            'datas' => ModelFormPolicy::search($this->search)
                ->where('tenant_id','=',Auth::user()->current_team_id)
                ->orderBy($this->sortBy,$this->sortDir)
                ->Paginate($this->perPage)

        ])->layout('content.app');
    }


    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete'];


    public $add_btn_title='Create Form Policy',$canvas_title='New Record',$set_display_name='Form Policy',$edit_id,$canvas_btn_title='Create';

    public  $env_field,$tier_field, $os_field, $mandatory_field,$optional_field,$status;


    public $_env,$_tier,$_os,$_as;


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

    public function mount(){
        $this->_env=ModelEnvironment::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->get();
        $this->_tier=ModelTier::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->get();
        $this->_os=ModelOS::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->get();
        $this->_as=ModelServiceApplication::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->get();
        $this->edit_id=NULL;
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


        $model= \App\Models\FormPolicy::where('id','=',$id)->first();
        $model->delete();

        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Delete Policy',
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

    public function click_close(){
        $this->dispatch('clear-canvas');
    }

    public function click_add(){
        $this->canvas_title = 'New Record';
        $this->canvas_btn_title='Create';
        $this->edit_id='';
        $this->id = '';
        $this->resetValidation();
        $this->dispatch('clear-canvas');
    }

    public function edit($id){
        $this->resetValidation();

        $record=ModelFormPolicy::where('id','=',$id)->first();

        $this->edit_id=$record->id;

        $this->canvas_title = 'Edit Record';
        $this->canvas_btn_title='Update';
        $this->status=$record->status;


        $this->dispatch('edit-canvas',[
            'env_field'=>$record->env_field,
            'tier_field'=>$record->tier_field,
            'os_field'=>$record->os_field,
            'status'=>$record->status,
            'mandatory_field'=>explode(',', $record->mandatory_field),
            'optional_field'=>explode(',', $record->optional_field),

        ]);


    }


    public function store()
    {


        $envValues =  ModelEnvironment::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->pluck('id')->toArray();
        $tierValues =  ModelTier::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->pluck('id')->toArray();
        $osValues =  ModelOS::where('tenant_id','=',Auth::user()->current_team_id)->where('status','=',1)->pluck('id')->toArray();
        //on form submit validation
        $this->validate([
            'env_field' => 'required|in:'.implode(',', $envValues).'|unique:form_policies,env_field,'.$this->edit_id.',id,tier_field,' . $this->env_field . ',os_field,' . $this->os_field . ',tenant_id,' . Auth::user()->current_team_id,
            'tier_field' => 'required|in:'.implode(',', $tierValues),
            'os_field' => 'required|in:'.implode(',', $osValues),
            'mandatory_field'=>'required',
            'optional_field'=>'required',
            'status' => 'in:0,1',
        ],

            [
                'env_field.unique' => 'This Policy Combo is exist.',
                'env_field.required' => 'This Environment field is required.',
                'tier_field.required' => 'This Tier field is required.',
                'os_field.required' => 'This Operating System field is required.',
                'm_field.required' => 'This Operating System field is required.',
                'mandatory_field.required' => 'This Mandatory field is required.',
                'optional_field.required' => 'This Optional field is required.',
                'tier_field.unique' => 'This Policy Combo is exist.',
                'os_field.unique' => 'This Policy Combo is exist.',
                'status.required' => 'The publish selected option is required.',

            ]
        );




        $record=ModelFormPolicy::updateOrCreate(
            [
                'id' => $this->edit_id,
            ],
            [
                'env_field' => $this->env_field,
                'tier_field' => $this->tier_field,
                'os_field' => $this->os_field,
                'mandatory_field' =>  implode(',',$this->mandatory_field),
                'optional_field' =>  implode(',',$this->optional_field),
                'status' => $this->status,
                'tenant_id' =>  Auth::user()->current_team_id,
                'updated_by' =>Auth::id(),

            ]
        );
        $_search_field= ' | '.$record->sa_man_name . ' | '. $record->sa_opt_name. ' | '. $record->env_name. ' | '. $record->tier_name. ' | '. $record->os_name. ' | '. $record->publish_status;
        $record->search_field=$_search_field;
        $record->save();
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
