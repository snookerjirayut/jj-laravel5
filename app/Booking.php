<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //

     protected $table = 'booking';



    protected $fillable = ['code', 'productName', 'userID' , 'userCode' , 'quantity' , 'totalPrice' , 'status' , 'sale_at' ];


    
}
