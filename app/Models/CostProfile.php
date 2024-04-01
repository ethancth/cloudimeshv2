<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostProfile extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    protected $fillable=[
        'name',
        'description',
        'vcpu',
        'vcpu_price',
        'form_vcpu_min',
        'form_vcpu_max',
        'vmen_price',
        'vmen',
        'form_vmen_min',
        'form_vmen_max',
        'vstorage',
        'vstorage_price',
        'vstorage_unit',
        'form_vstorage_min',
        'form_vstorage_max',
        'is_default',
        'tenant_id',
        'updated_by',



    ];

    public function tenant()
    {
        return $this->belongsTo(Team::class,'id','tenant_id');
    }

    public function getEnvDisplayNameAttribute()
    {
        return $this->display_name;
    }
    public function getDefaultTypeAttribute(){
        return $this->is_default ? 'Default' : 'Custom';
    }


    public function getPublishStatusAttribute()
    {
        return $this->status ? 'Active' : 'InActive';
    }


    public function scopeSearch($query, $value){
        $query->where('name','like',"%{$value}%");
    }

    public function getLastUpdateAttribute(){
        if($this->updated_by==0){
            return "System";
        }else{
            return User::find($this->updated_by)->first()->name;
        }

    }
}
