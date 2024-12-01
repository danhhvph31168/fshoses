<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable=['code','type','value','is_active','minimum_order_value','start_date', 'end_date','quantity'];

    public static function findByCode($code){
        return self::where('code',$code)->first();

    }

    public function discount($total){
        if($this->type=="fixed"){
            return $this->value*100;
        }
        elseif($this->type=="percent"){
            return ($this->value /100)*$total;
        }
        else{
            return 0;
        }
    }
}
