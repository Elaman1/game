<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DBUser;
use Auth;

class UserPostController extends Controller
{
    public function step(Request $request) {
        User::toStep();
        return back();
    }

    public function spendingFoodChange(Request $request) {
        $validate = $request->validate([
            'food' => 'required|integer|min:1'
        ]);

        DBUser::updateSpending("food_id", $validate['food']);

        return redirect('spending');
    }

    public function spendingChange(Request $request) {
        if(isset($request->home_id)) {
            $validate = $request->validate([
                'home_id' => 'required|integer|min:1',
            ]);

            $home = Spending::spendingHome($validate['home_id']);
            $oldHome = User::home()->price ?? 0;
            $totalMoney = Auth::user()->money - $home->price + $oldHome;
            if ($totalMoney >= 0) {
                User::where('id', Auth::id())->update(['money' => $totalMoney]);
                DBUser::updateSpending("home_id", $validate['home_id']);
            } else {
                session(['status' => 'У вас недостаточно средств']);
            }

        }
        elseif (isset($request->transport_id)) {
            $validate = $request->validate([
                'transport_id' => 'required|integer|min:1',
            ]);
            $car = Spending::spendingTransport($validate['transport_id']);
            $oldCar = User::car()->price ?? 0;
            $totalMoney = Auth::user()->money - $car->price + $oldCar;
            if ($totalMoney >= 0) {
                User::where('id', Auth::id())->update(['money' => $totalMoney]);
                DBUser::updateSpending("transport_id", $validate['transport_id']);
            } else {
                session(['status' => 'У вас недостаточно средств']);
            }
        }
        else {
            session(['status' => 'Произошла ошибка']);
        }


        return redirect('spending');
    }

    public function searchWork(Request $request) {
        if (DBUser::minusEnergy(30)) {
            DBUser::getWork();
        } else {
            session(['status' => 'Недостаточно энергии']);
        }
        return redirect('career');

    }

    public function moreWork(Request $request) {
        if (DBUser::minusEnergy(25))
            DBUser::plusChanceUpPostWork(3);
        else
            session(['status' => 'Недостаточно энергии']);

        return redirect('career');
    }

    public function upPost(Request $request) {
        $chanceUpPost = User::userWork();
        if (DBUser::procentWorkForStay($chanceUpPost->chance_up))
            DBUser::upPostWork();

        else {
            DBUser::minusChanceUpPostWork();
            session(['status' => 'Повышение не удалось']);
        }
        return redirect('career');
    }

    public function spendingServant(Request $request) {
        DBUser::updateSpending('servant', 1);
        return redirect('spending');
    }

    public function spendingServantDelete(Request $request) {
        DBUser::updateSpending('servant', 0);
        return redirect('spending');
    }

    public function getOutWork(Request $request) {
        DBUser::getOutWork();
        return redirect('career');
    }

    public function spendingDelete(Request $request) {

        if(isset($request->home_id)) {
            $validate = $request->validate([
                'home_id' => 'required|integer|min:1',
            ]);
            $oldHome = User::home()->price;
            $totalMoney = Auth::user()->money + $oldHome;
            User::where('id', Auth::id())->update(['money' => $totalMoney]);
            DBUser::updateSpending("home_id", null);
        }

        elseif(isset($request->transport_id)) {
            $validate = $request->validate([
                'transport_id' => 'required|integer|min:1',
            ]);
            $oldCar = User::home()->price;
            $totalMoney = Auth::user()->money + $oldCar;
            User::where('id', Auth::id())->update(['money' => $totalMoney]);
            DBUser::updateSpending("transport_id", null);
        }
        else {
            session(['status' => 'Произошла ошибка']);
        }
        return redirect('spending');
    }
}
