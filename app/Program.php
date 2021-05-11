<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// kalau mau pakai softDeletes Harus di summon disini
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    // kalau mau pakai softdelete summon disini
    use SoftDeletes;   
    
    // protected $fillable['name'];
    protected $guarded=['student_max'];

    protected $fillable = ['edulevel_id', 'name', 'student_price', 'info'];

    public function edulevel(){
        return $this->belongsTo('App\Edulevel');
    }
}
