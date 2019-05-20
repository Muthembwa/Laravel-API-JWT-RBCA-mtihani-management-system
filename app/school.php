<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class school extends Model
{
    //use SoftDeletes;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable=['schoolname'];
   
     /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [];


    //users relationship
   public function users()
   {
       return $this
       ->hasMany(User::class); 
   }

   //streams relationship
   public function streams()
   {
       return $this
       ->hasMany(Stream::class); 
   }

   //subjects relationship
   public function subjects()
   {
       return $this
       ->belongsToMany(Subject::class)
       ->as ('subjects')
       ->withTimestamps(); 
   }

   //exams relationship
   public function exams()
   {
       return $this
       ->belongsToMany(Exam::class)
       ->as('exams')
       ->withTimestamps(); 
   }

   //students in a school 
   public function students()
   {
       return $this->hasManyThrough('App\Student', 'App\Stream');
   }
   //marks for the school through exams
   public function marks()
   {
       return $this->hasManyThrough('App\Mark', 'App\Exam');
   }

}
