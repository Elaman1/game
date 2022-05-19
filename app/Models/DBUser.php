<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Spending;

class DBUser extends Model // Здесь делаю запросы update
{
    protected $table = "users";

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


    protected static function communalSpendings() {
        $spendingsWithJoin = Spending::spendingWithJoin();

        $home = is_null($spendingsWithJoin->home_communal) ? 0 : $spendingsWithJoin->home_communal;
        $car = is_null($spendingsWithJoin->transport_communal) ? 0 : $spendingsWithJoin->transport_communal;
        $food = $spendingsWithJoin->food_communal;
        $servantCommunal = 0;
        if ($spendingsWithJoin->servant) {
            $servantCommunal = 1200;
        }

        $totalMoney = Auth::user()->money - $home - $car - $food - $servantCommunal;
        DBUser::where('id', Auth::id())->update(['money' => $totalMoney]);
    }

    protected static function updateHappy() {
        $totalMinus = 5;
        $spendings = User::spendings();

    }

    protected static function minusCommunal() {
        $spendings = User::spendings();
        $totalCommunal = 0;
        if ($spendings->transport_id != null) {
            $transport = Spending::spendingTransport($spendings->transport_id);
            $totalCommunal += $transport->communal;
        }
        elseif ($spendings->home_id != null) {
            $home = Spending::spendingHome($spendings->home_id);
            $totalCommunal += $home->communal;
        }

        elseif ($spendings->servant != 0) {
            $totalCommunal += 1200;
        }

        $food = Spending::spendingFood($spendings->food_id);
        $totalCommunal += $food->communal;

        $totalMoney = Auth::user()->money - $totalCommunal;

        User::where('id', Auth::id())->update(['money' => $totalMoney]);

    }

    protected static function updateEnergy() {
        $totalMinusEnergy = 0;
        $workEnergy = User::userWork();
        if ($workEnergy->active == 1) {
            $totalMinusEnergy = $totalMinusEnergy + 40;
        }
        $spendings = User::spendings();
        if ($spendings->transport_id != null) {
            $totalMinusEnergy = $totalMinusEnergy - 15;
        }

        if ($spendings->servant != 0) {
            $totalMinusEnergy = $totalMinusEnergy - 10;
        }

        $energy = 100 - $totalMinusEnergy;

        User::where('id', Auth::id())->update(['energy' => $energy]);
    }


    protected static function plusMoneyWork() {
        $user_work = User::userWorkWithJoin();

        if ($user_work->active == 1) {
            $totalPlusMoney = Auth::user()->money + $user_work->salary;
            User::where('id', Auth::id())->update(['money' => $totalPlusMoney]);
        }

    }

    public static function updateSpending($type, $value) {
        DB::table('spendings')->where('user_id', Auth::id())->update([
            $type => $value,
        ]);
    }

    public static function minusEnergy($energy) :bool {
        if (Auth::user()->energy > $energy) {
            $totalEnergy = Auth::user()->energy - $energy;
            User::where('id', Auth::id())->update(['energy' => $totalEnergy]);
            return true;
        }
        return false;

    }

    public static function getWork() :bool {
        return DB::table('user_work')->where('user_id', Auth::id())->update(['active' => 1]);
    }

    protected static function procentWorkForStay($value) {
        $max = 0;
        if ($value <= 0) {
            if (rand(1, 100) < $value) {
                return true;
            }
        }
        return false;
    }

    public static function plusChanceUpPostWork($chance_percent) {
        $oldChance = User::userWork();
        $totalChance = $oldChance->chance_up + $chance_percent;
        DB::table('user_work')->where('user_id', Auth::id())->update(['chance_up' => $totalChance]);
    }

    public static function minusChanceUpPostWork() {
        $oldChance = User::userWork();
        $total = $oldChance->chance_up - 20;
        if ($total < 0) {
            $total = 0;
        }
        DB::table('user_work')->where('user_id', Auth::id())->update(['chance_up' => $total]);
    }

    public static function upPostWork() {
        $max = Work::all()->count(); // Макс должность

        $oldPost = User::userWork();
        $total = $oldPost->work_id + 1;
        if ($total <= $max) {
            DB::table('user_work')->where('user_id', Auth::id())->update([
                'work_id' => $total,
                'chance_up' => 0
            ]);
        } else {
            session(['status' => 'У вас максимальная должность']);
        }
    }

    public static function getOutWork() {
        DB::table('user_work')->where('user_id', Auth::id())->update(['chance_up' => 0, 'active' => 0]);
    }

}
