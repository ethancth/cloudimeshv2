<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;



    protected $fillable = [
      'tenant_id', 'name','default','updated_by'
    ];

    protected $casts = [
      'default' => 'boolean',
    ];

    public function tenant()
    {
      return $this->belongsTo(Team::class,'id','tenant_id');
    }

    public function getLastUpdateAttribute(){
        if($this->updated_by==0){
            return "System";
        }else{
            return User::find($this->updated_by)->first()->name;
        }

    }

    public function scopeSearch($query, $value){
        $query->where('name','like',"%{$value}%");
    }

}
