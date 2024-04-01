<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','operating_system',
        'v_cpu','v_memory','environment','tier',
        'hostname', 'owner','created_at', 'updated_at',
        'total_storage','operating_system_option','optional_sa_field','mandatory_sa_field',
        'display_os','display_tier','display_env','price','is_vm_provision',
        'is_asset_vm','price_actual'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'id','owner');
    }

    public function scopeSearch($query, $value){
        $query->where('hostname','like',"%{$value}%")->orWhere('price','like',"%{$value}%")->orWhere('display_env','like',"%{$value}%")->orWhere('display_tier','like',"%{$value}%")->orWhere('display_os','like',"%{$value}%")->where('user_id','=',Auth::id());
    }

}
