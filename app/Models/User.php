<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use \App\Models\DBUser;

class User extends Authenticatable // Здесь делаю запросы select
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'money', 'energy', 'popularity', 'impact'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function spendings() {
        return DB::table('spendings')->where('id', Auth::id())->first();
    }

    public static function home() {
        return DB::table('spending_home')
            ->where('spendings.user_id', Auth::id())
            ->leftJoin('spendings', 'spendings.home_id', '=', 'spending_home.id')
            ->select('spending_home.*')
            ->first();
    }

    public static function car() {
        return DB::table('spending_transport')
            ->where('spendings.user_id', Auth::id())
            ->leftJoin('spendings', 'spendings.transport_id', '=', 'spending_transport.id')
            ->select('spending_transport.*')
            ->first();
    }

    public static function food() {
        return DB::table('spending_food')
            ->where('spendings.user_id', Auth::id())
            ->leftJoin('spendings', 'spendings.food_id', '=', 'spending_food.id')
            ->select('spending_food.*')
            ->first();
    }

    public static function work() {
        return DB::table('works')
            ->where('user_work.user_id', Auth::id())
            ->leftJoin('user_work', 'user_work.work_id', '=', 'works.id')
            ->select('works.*')
            ->first();
    }

    public static function userWork() {
        return DB::table('user_work')->where('user_id', Auth::id())->first();
    }

    public static function userWorkWithJoin() {
        return DB::table('user_work')->where('user_id', Auth::id())
            ->join('works', 'user_work.work_id', '=', 'works.id')
            ->select('user_work.active', 'works.salary')
            ->first();
    }

    public static function toStep() { // Зароботок с работ и расходы
        DBUser::plusMoneyWork();
        DBUser::minusCommunal();
        DBUser::updateHappy();
        DBUser::communalSpendings();
        DBUser::updateEnergy();
    }

}
