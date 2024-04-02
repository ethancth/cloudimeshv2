<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FormPolicy extends Model
{

    protected $fillable=['env_field','tier_field','os_field','mandatory_field','optional_field','tenant_id','updated_by','status'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];


    public function scopeSearch($query, $value){
        $query->where('search_field','like',"%{$value}%");
    }

    public function getLastUpdateAttribute(){
        if($this->updated_by==0){
            return "System";
        }else{
            return User::find($this->updated_by)->first()->name;
        }

    }


    public function getPublishStatusAttribute()
    {
        return $this->status ? 'Active' : 'InActive';
    }

    public function getEnvNameAttribute(){
        $data=Environment::find($this->env_field);
        return $data->display_name;
    }

    public function getTierNameAttribute(){
        $data=Tier::find($this->env_field);
        return $data->display_name;
    }

    public function getOsNameAttribute(){
        $data=OperatingSystem::find($this->env_field);
        return $data->display_name;
    }

    public function getSAManNameAttribute()
    {

        $myArray = explode(',', $this->mandatory_field);

      //  dd($this->mandatory_field,$myArray);
        $sas=ServiceApplication::select("display_name")
            ->whereIn('id', $myArray)
            ->get();

        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name.", ";
        }
        $resuleName=substr($_new_name, 0, -2);
        return $a=$resuleName;

    }
    public function getSAOptNameAttribute()
    {

        $myArray = explode(',', $this->optional_field);

        //  dd($this->mandatory_field,$myArray);
        $sas=ServiceApplication::select("display_name")
            ->whereIn('id', $myArray)
            ->get();

        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name.", ";
        }
        $resuleName=substr($_new_name, 0, -2);
        return $a=$resuleName;

    }




}
