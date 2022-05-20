<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $name = "Elaman";
        return view('cabinet');
    }

    public function spending()
    {
        $spending = Spending::spendingWithJoin();

        $homes = DB::table('spending_home')->get();
        $cars = DB::table('spending_transport')->get();
        $foods = DB::table('spending_food')->get();

        return view('spending', compact('spending', 'homes', 'cars', 'foods'));
    }

    public function career() {
        $work = User::work();
        $pivotUserWork = User::userWork();
        return view('career', compact('work', 'pivotUserWork'));
    }








}
