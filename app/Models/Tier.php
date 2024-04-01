<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    protected $fillable=['name','display_name','tenant_id','display_description','status','display_icon','display_icon_colour','is_default','update_at','updated_by'];

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
