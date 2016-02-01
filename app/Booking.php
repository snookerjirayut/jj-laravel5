<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use App\User;

class Booking extends Model
{
    //

    protected $table = 'booking';

    protected $appends = ['miliseconds' , 'canCheckIn'];


    protected $fillable = ['code', 'productName', 'userID' , 'userCode' , 'quantity' 
    , 'totalPrice' , 'status' , 'sale_at' , 'payment' , 'picture' , 'type' ];


    public function bookingdetail(){
    	return $this->hasMany('App\BookingDetail' , 'bookingID');
    }
    
    public function setMilisecondsAttribute($value){
    	$this->attributes['miliseconds'] = strtotime($value) * 1000;
    }

    public function getMilisecondsAttribute(){
    	return $this->attributes['miliseconds'] = strtotime($this->sale_at) * 1000;
    }

    public function getCanCheckInAttribute(){
        $date_sale = new DateTime($this->sale_at);
        $date_now = new DateTime("now");
        //$date_now = new DateTime("2015-12-26");
        $interval = date_diff($date_now , $date_sale);
        if($this->status == "CN"){ return false;}
        $str =  $interval->format('%R%d');
        if( $str >= 0  && $str <= 1 ){
            //return true;
            $user = User::where('id' , $this->userID)->first();
            if($user->role == 1){
                //user guest
                return $this->validateCheckin();
            }
            //user member
            return true;
        }

        return false;

    }

    public function validateCheckin(){
        if($this->type == 1){
            if($this->payment == 2) return true;
            else return false;
        }else {
            return true;
        }

    }

}
