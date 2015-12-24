<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    //calendar
    protected $table = 'calendar';

 	protected $appends = ['miliseconds' ];

 	public function getMilisecondsAttribute(){
    	return $this->attributes['miliseconds'] = strtotime($this->opened_at) * 1000;
    }
}
