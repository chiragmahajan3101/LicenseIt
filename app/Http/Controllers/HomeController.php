<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Software;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $numberOfUsers = User::where('role', 0)->count();
        $numberOfProducts = Software::all()->count();
        $totalActiveUsers = License::where('active_status', 1)->get()->keyBy('buyer_id')->count();
        $totalInActiveUsers = $numberOfUsers - $totalActiveUsers;
        $totalLicensesUnExpired = License::where('expiry_date', ">=", now())->count();
        $totalLicensesExpired = License::where('expiry_date', "<", now())->count();
        $licenseSoldByMonth = [];
        if (date("m") < 4) {
            $year1 = date("Y") - 1;
            $year2 = date("Y");
            $licenseSoldByMonth["april"] = License::whereBetween('buy_date', array((string)$year1 . '-04-01', (string)$year1 . '-05-01'));
            $licenseSoldByMonth["may"] = License::whereBetween('buy_date', array((string)$year1 . '-05-01', (string)$year1 . '-06-01'));
            $licenseSoldByMonth["june"] = License::whereBetween('buy_date', array((string)$year1 . '-06-01', (string)$year1 . '-07-01'));
            $licenseSoldByMonth["july"] = License::whereBetween('buy_date', array((string)$year1 . '-07-01', (string)$year1 . '-08-01'));
            $licenseSoldByMonth["august"] = License::whereBetween('buy_date', array((string)$year1 . '-08-01', (string)$year1 . '-09-01'));
            $licenseSoldByMonth["september"] = License::whereBetween('buy_date', array((string)$year1 . '-09-01', (string)$year1 . '-10-01'));
            $licenseSoldByMonth["october"] = License::whereBetween('buy_date', array((string)$year1 . '-10-01', (string)$year1 . '-11-01'));
            $licenseSoldByMonth["november"] = License::whereBetween('buy_date', array((string)$year1 . '-11-01', (string)$year1 . '-12-01'));
            $licenseSoldByMonth["december"] = License::whereBetween('buy_date', array((string)$year1 . '-12-01', (string)$year2 . '-01-01'));
            $licenseSoldByMonth["january"] = License::whereBetween('buy_date', array((string)$year2 . '-01-01', (string)$year2 . '-02-01'));
            $licenseSoldByMonth["february"] = License::whereBetween('buy_date', array((string)$year2 . '-02-01', (string)$year2 . '-03-01'));
            $licenseSoldByMonth["march"] = License::whereBetween('buy_date', array((string)$year2 . '-03-01', (string)$year2 . '-04-01'));
        } else {
            $year1 = date("Y");
            $year2 = date("Y") + 1;
            $licenseSoldByMonth["april"] = License::whereBetween('buy_date', array((string)$year1 . '-04-01', (string)$year1 . '-05-01'));
            $licenseSoldByMonth["may"] = License::whereBetween('buy_date', array((string)$year1 . '-05-01', (string)$year1 . '-06-01'));
            $licenseSoldByMonth["june"] = License::whereBetween('buy_date', array((string)$year1 . '-06-01', (string)$year1 . '-07-01'));
            $licenseSoldByMonth["july"] = License::whereBetween('buy_date', array((string)$year1 . '-07-01', (string)$year1 . '-08-01'));
            $licenseSoldByMonth["august"] = License::whereBetween('buy_date', array((string)$year1 . '-08-01', (string)$year1 . '-09-01'));
            $licenseSoldByMonth["september"] = License::whereBetween('buy_date', array((string)$year1 . '-09-01', (string)$year1 . '-10-01'));
            $licenseSoldByMonth["october"] = License::whereBetween('buy_date', array((string)$year1 . '-10-01', (string)$year1 . '-11-01'));
            $licenseSoldByMonth["november"] = License::whereBetween('buy_date', array((string)$year1 . '-11-01', (string)$year1 . '-12-01'));
            $licenseSoldByMonth["december"] = License::whereBetween('buy_date', array((string)$year1 . '-12-01', (string)$year2 . '-01-01'));
            $licenseSoldByMonth["january"] = License::whereBetween('buy_date', array((string)$year2 . '-01-01', (string)$year2 . '-02-01'));
            $licenseSoldByMonth["february"] = License::whereBetween('buy_date', array((string)$year2 . '-02-01', (string)$year2 . '-03-01'));
            $licenseSoldByMonth["march"] = License::whereBetween('buy_date', array((string)$year2 . '-03-01', (string)$year2 . '-04-01'));
        }

        $maxLicenseBoughtBy = License::select('buyer_id', DB::raw('count(*) as total'))->orderBy('total', "DESC")->with('buyer')->limit(5)->groupBy('buyer_id')->get()->flatten()->toArray();

        return view(compact(['numberOfUsers', 'numberOfProducts', 'totalActiveUsers', 'totalInActiveUsers', 'totalLicensesUnExpired', 'totalLicensesExpired', 'licenseSoldByMonth', 'maxLicenseBoughtBy']));
    }
}
