<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_order_value',
        'is_active',
        'start_date',
        'end_date',
        'quantity'
    ];


    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }


    public function discount($total)
    {
        if ($this->type == "fixed") {
            return $this->value;
        } elseif ($this->type == "percent") {
            return ($this->value / 100) * $total;
        } else {
            return 0;
        }
    }


    public function updateActiveStatus()
    {
        if (Carbon::now()->greaterThan($this->end_date)) {
            $this->is_active = false;
            $this->save();
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
