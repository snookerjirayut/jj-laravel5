<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'bookingDetail';


    protected $fillable = ['code', 'bookingID', 'bookingCode' , 'zoneID' , 'zoneCode' , 'zoneNumber' , 'price' , 'status' , 'sale_at'];

}
