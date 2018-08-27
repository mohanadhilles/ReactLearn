<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use SoftDeletes;

    protected $fillable = ['start', 'end', 'employee_id'];
    protected $hidden = [];

    public function setEmployeeIdAttribute($input)
    {
        $this->attributes['employee_id'] = $input ? $input : null;
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }



}
