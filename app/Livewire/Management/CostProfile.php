<?php

namespace App\Livewire\Management;

use App\Models\CostProfile as ModelClass;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CostProfile extends Component
{
    public
        $id,
        $name,
        $description,
        $vcpu_price,
        $form_vcpu_min,
        $form_vcpu_max,
        $vmen_price,
        $form_vmen_min,
        $form_vmen_max,
        $vstorage_price,
        $form_vstorage_min,
        $form_vstorage_max
    ;
    public function mount(){
        $data = ModelClass::where('tenant_id','=',Auth::user()->current_team_id)->first();
        $this->id=$data->id;
        $this->name=$data->name;
        $this->description=$data->description;
        $this->vcpu_price=$data->vcpu_price;
        $this->form_vcpu_min=$data->form_vcpu_min;
        $this->form_vcpu_max=$data->form_vcpu_max;
        $this->vmen_price=$data->vmen_price;
        $this->form_vmen_min=$data->form_vmen_min;
        $this->form_vmen_max=$data->form_vmen_max;
        $this->vstorage_price=$data->vstorage_price;
        $this->form_vstorage_min=$data->form_vstorage_min;
        $this->form_vstorage_max=$data->form_vstorage_max;

    }
    public function render()
    {
        return view('livewire.management.cost-profile',[
            'data' => ModelClass::where('tenant_id','=',Auth::user()->current_team_id)->first()

                ]);

    }

    public function store()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required|max:100|min:5',
            'description' => 'required|max:100|min:5',
            'vcpu_price' => 'required|numeric|max:9999|min:0',
            'form_vcpu_min' => 'required|numeric|max:9999|min:0',
            'form_vcpu_max' => 'required|numeric|max:9999|min:0',
            'vmen_price' => 'required|numeric|max:9999|min:0',
            'form_vmen_min' => 'required|numeric|max:9999|min:0',
            'form_vmen_max' => 'required|numeric|max:9999|min:0',
            'vstorage_price' => 'required|numeric|max:9999|min:0',
            'form_vstorage_min' => 'required|numeric|max:9999|min:0',
            'form_vstorage_max' => 'required|numeric|max:9999|min:0',

        ],

            [
//                'name.required' => 'The '.$this->set_display_name.' name field is required.',
//                'status.required' => 'The publish selected option is required.',
//                'name.min' => $this->set_display_name.' Name Should be Minimum of 5 Character.',
//                'name.max' => $this->set_display_name.' Name Must not be greater than 100 characters.',
//                'name.unique' => $this->set_display_name.' Name has already been taken.'
            ]
        );

        //Add Data into Post table Data
        $record=ModelClass::updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'name' => $this->name,
                'description' => $this->description,
                'vcpu_price' => $this->vcpu_price,
                'form_vcpu_min' => $this->form_vcpu_min,
                'form_vcpu_max' => $this->form_vcpu_max,
                'vmen_price' => $this->vmen_price,
                'form_vmen_min' => $this->form_vmen_min,
                'form_vmen_max' => $this->form_vmen_max,
                'vstorage_price' => $this->vstorage_price,
                'form_vstorage_min' => $this->form_vstorage_min,
                'form_vstorage_max' => $this->form_vstorage_max,
                'updated_by' =>Auth::id(),

            ]
        );

        $_store_status='Updated';

        $this->dispatch('close-canvas');
        $this->title = '';

        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully '.$_store_status.' ',
            'text'=>'',
        ]);


    }

}
