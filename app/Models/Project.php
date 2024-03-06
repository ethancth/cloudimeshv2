<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

  public $incrementing = false;


  protected $fillable = [
    'title', 'owner','created_at', 'updated_at', 'slug','price','total_cpu','total_memory','total_server','total_server_on','total_storage','company_id','price_actual'
  ];


  protected $casts = [
    'created_at' => 'date:d-m-Y',
  ];

  public function owner()
  {
    return $this->hasMany(User::class,'user_id','id');
  }
  public function owner2()
  {
    return $this->hasMany(User::class,'id','user_id');
  }

  public function scopeSearch($query, $value){
    $query->where('title','like',"%{$value}%")->orWhere('price','like',"%{$value}%")->orWhere('status','like',"%{$value}%")->where('user_id','=',Auth::id());
  }

  public function getProjectStatusAttribute()
  {
    if($this->status==1){
      return 'Draft';
    }
    if($this->status==2){
      return 'Review';
    }
    if($this->status==3){
      return 'Approve';
    }
    if($this->status==4){
      return 'In-Provisioning';
    }
    if($this->status==5){
      return 'Complete';
    }

  }

  public function scopeWithStatus($query, $status)
  {

    //dd($status);
    switch ($status) {
      case 'draft':
        $query->ProjectDraft();
        break;
      case 'review':
        $query->ProjectReview();
        break;
      case 'approve':
        $query->ProjectApprove();
        break;
      case 'in-provision':
        $query->ProjectInProvision();
        break;
      case 'complete':
        $query->ProjectComplete();
        break;

      default:
        $query->ProjectAll();
        break;
    }
  }
  public function scopeProjectDraft($query)
  {
    return $query->where('status', '1');
  }

  public function scopeProjectReview($query)
  {
    return $query->where('status', '2');
  }

  public function scopeProjectApprove($query)
  {
    return $query->where('status', '3');
  }

  public function scopeProjectInProvision($query)
  {
    return $query->where('status', '4');
  }

  public function scopeProjectComplete($query)
  {
    return $query->where('status', '5');
  }

  public function scopeProjectAll($query)
  {
    return $query;
  }



}
