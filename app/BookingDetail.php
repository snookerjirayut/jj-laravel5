<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'bookingDetail';


    protected $fillable = ['code', 'bookingID', 'bookingCode' , 'zoneID' , 'zoneCode' , 'zoneNumber' , 'price' , 'status' , 'sale_at'];


	public function bookingID()
    {
        return $this->belongsTo('App\Booking');
    }

  /*  public function setMilisecondsAttribute($value){
    	$this->attributes['miliseconds'] = strtotime($value) * 1000;
    }*/

}
