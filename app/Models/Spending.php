<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Spending extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_id', 'user_id', 'transport_id', 'food_id', 'servant'
    ];

    protected $hidden = [
        'price', 'image', 'communal',
    ];

    public static function spendingTransport($transport_id) {
        return DB::table('spending_transport')->where('id', $transport_id)->first();
    }

    public static function spendingHome($home_id) {
        return DB::table('spending_home')->where('id', $home_id)->first();
    }

    public static function spendingFood($food_id) {
        return DB::table('spending_food')->where('id', $food_id)->first();
    }

    public static function spendingWithJoin() {
        return DB::table('spendings')->where('user_id', Auth::id())
            ->leftJoin('spending_home', 'spendings.home_id', '=', 'spending_home.id')
            ->leftJoin('spending_transport', 'spendings.transport_id', '=', 'spending_transport.id')
            ->leftJoin('spending_food', 'spendings.food_id', '=', 'spending_food.id')
            ->select(
                'spendings.*',
                'spending_home.happy_home',
                'spending_home.price as home_price',
                'spending_home.communal as home_communal',
                'spending_home.image as home_image',

                'spending_transport.happy_car',
                'spending_transport.price as transport_price',
                'spending_transport.communal as transport_communal',
                'spending_transport.image as transport_image',

                'spending_food.health_food',
                'spending_food.price as food_price',
                'spending_food.communal as food_communal',
                'spending_food.title as food_title'
            )
            ->first();
    }

}
