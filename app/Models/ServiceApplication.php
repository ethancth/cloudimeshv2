<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ServiceApplication extends Model
{
    protected $casts=[
        'cost' => 'decimal:2',
    ];
    use HasFactory;
    public $fillable=['display_name',
        'display_description',
        'name',
        'enable_status',
        'tenant_id',
        'cost',
        'status',
        'is_one_time_payment',
        'is_cost_per_core',
        'cpu_amount',
        'is_default',
        'updated_by',
    ];

    public function tenant(){
        return $this->belongsTo(team::class,'tenant_id');
    }

    public function scopeSearch($query, $value){
        $query->where('display_name','like',"%{$value}%")->orWhere('cost','like',"%{$value}%")->where('tenant_id','=',Auth::user()->current_tenant_id);
    }

    public function getDefaultTypeAttribute(){
        return $this->is_default ? 'Default' : 'Custom';
    }

    public function getPublishStatusAttribute()
    {
        return $this->status ? 'Active' : 'InActive';
    }
    public function getLastUpdateAttribute(){
        if($this->updated_by==0){
            return "System";
        }else{
            return User::find($this->updated_by)->first()->name;
        }

    }
}
