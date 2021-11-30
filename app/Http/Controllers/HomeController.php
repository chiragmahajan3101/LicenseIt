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
            $licenseSoldByMonth["april"] = License::whereBetween('buy_date', array((string)$year1 . '-04-01', (string)$year1 . '-04-30'));
            $licenseSoldByMonth["may"] = License::whereBetween('buy_date', array((string)$year1 . '-05-01', (string)$year1 . '-05-31'));
            $licenseSoldByMonth["june"] = License::whereBetween('buy_date', array((string)$year1 . '-06-01', (string)$year1 . '-06-30'));
            $licenseSoldByMonth["july"] = License::whereBetween('buy_date', array((string)$year1 . '-07-01', (string)$year1 . '-07-31'));
            $licenseSoldByMonth["august"] = License::whereBetween('buy_date', array((string)$year1 . '-08-01', (string)$year1 . '-08-31'));
            $licenseSoldByMonth["september"] = License::whereBetween('buy_date', array((string)$year1 . '-09-01', (string)$year1 . '-09-30'));
            $licenseSoldByMonth["october"] = License::whereBetween('buy_date', array((string)$year1 . '-10-01', (string)$year1 . '-10-31'));
            $licenseSoldByMonth["november"] = License::whereBetween('buy_date', array((string)$year1 . '-11-01', (string)$year1 . '-11-30'));
            $licenseSoldByMonth["december"] = License::whereBetween('buy_date', array((string)$year1 . '-12-01', (string)$year2 . '-12-30'));
            $licenseSoldByMonth["january"] = License::whereBetween('buy_date', array((string)$year2 . '-01-01', (string)$year2 . '-01-31'));
            if (($year2 % 4) == 0) {
                $licenseSoldByMonth["february"] = License::whereBetween('buy_date', array((string)$year2 . '-02-01', (string)$year2 . '-02-29'));
            } else {
                $licenseSoldByMonth["february"] = License::whereBetween('buy_date', array((string)$year2 . '-02-01', (string)$year2 . '-02-28'));
            }
            $licenseSoldByMonth["march"] = License::whereBetween('buy_date', array((string)$year2 . '-03-01', (string)$year2 . '-03-31'));
            $totalSales = 0;
            foreach ($licenseSoldByMonth as $licenseSoldByMonthEach) {
                $totalSales += $licenseSoldByMonthEach->count();
                var_dump($licenseSoldByMonthEach->count());
            }
            $licenseSoldByMonth["total"] =  $totalSales;
        } else {
            $year1 = date("Y");
            $year2 = date("Y") + 1;
            $licenseSoldByMonth["april"] = License::whereBetween('buy_date', array((string)$year1 . '-04-01', (string)$year1 . '-04-30'));
            $licenseSoldByMonth["may"] = License::whereBetween('buy_date', array((string)$year1 . '-05-01', (string)$year1 . '-05-31'));
            $licenseSoldByMonth["june"] = License::whereBetween('buy_date', array((string)$year1 . '-06-01', (string)$year1 . '-06-30'));
            $licenseSoldByMonth["july"] = License::whereBetween('buy_date', array((string)$year1 . '-07-01', (string)$year1 . '-07-31'));
            $licenseSoldByMonth["august"] = License::whereBetween('buy_date', array((string)$year1 . '-08-01', (string)$year1 . '-08-31'));
            $licenseSoldByMonth["september"] = License::whereBetween('buy_date', array((string)$year1 . '-09-01', (string)$year1 . '-09-30'));
            $licenseSoldByMonth["october"] = License::whereBetween('buy_date', array((string)$year1 . '-10-01', (string)$year1 . '-10-31'));
            $licenseSoldByMonth["november"] = License::whereBetween('buy_date', array((string)$year1 . '-11-01', (string)$year1 . '-11-30'));
            $licenseSoldByMonth["december"] = License::whereBetween('buy_date', array((string)$year1 . '-12-01', (string)$year2 . '-12-30'));
            $licenseSoldByMonth["january"] = License::whereBetween('buy_date', array((string)$year2 . '-01-01', (string)$year2 . '-01-31'));
            if (($year2 % 4) == 0) {
                $licenseSoldByMonth["february"] = License::whereBetween('buy_date', array((string)$year2 . '-02-01', (string)$year2 . '-02-29'));
            } else {
                $licenseSoldByMonth["february"] = License::whereBetween('buy_date', array((string)$year2 . '-02-01', (string)$year2 . '-02-28'));
            }
            $licenseSoldByMonth["march"] = License::whereBetween('buy_date', array((string)$year2 . '-03-01', (string)$year2 . '-03-31'));
            $totalSales = 0;
            foreach ($licenseSoldByMonth as $licenseSoldByMonthEach) {
                $totalSales += $licenseSoldByMonthEach->count();
            }
            $licenseSoldByMonth["total"] =  $totalSales;
        }

        $maxLicenseBoughtBy = License::select('buyer_id', DB::raw('count(*) as total'))->orderBy('total', "DESC")->with('buyer')->limit(5)->groupBy('buyer_id')->get()->flatten()->toArray();

        return view('dashboard', compact(['numberOfUsers', 'numberOfProducts', 'totalActiveUsers', 'totalInActiveUsers', 'totalLicensesUnExpired', 'totalLicensesExpired', 'licenseSoldByMonth', 'maxLicenseBoughtBy', 'year1', 'year2']));
    }
}
