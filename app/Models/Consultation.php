<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Consultation extends Model
{
protected $fillable = ['user_id','doctor_id','notes','status','scheduled_at'];


public function doctor() { return $this->belongsTo(Doctor::class); }
}