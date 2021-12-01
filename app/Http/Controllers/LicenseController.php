<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::with('software', 'buyer')
            ->search()
            ->orderBy('buy_date', "DESC")
            ->get();

        // dd($licenses);
        $licensesData = [];
        foreach ($licenses as $license) {
            $eachData = [
                $license->id,
                $license->buyer->name,
                $license->buyer->email,
                $license->software->software_name,
                $license->buy_dates,
                $license->expire_status,
                $license->active_status_style,
                $license->used_count,
                $license->action_buttons
            ];
            array_push($licensesData, $eachData);
        }
        // dd($licensesData);

        $emails = License::with('buyer')->join('users', 'users.id', '=', 'licenses.buyer_id')->orderBy('users.name')->get()->keyBy('buyer_id');
        return view('layouts.License.index', compact(['emails', 'licensesData']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        dd("hello");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        //
    }

    public function bills()
    {
        $bills = License::select('amount', 'software_id', 'buyer_id', 'buy_date', 'expiry_date', 'transaction_id')
            ->with('software', 'buyer')
            ->join('users', 'users.id', '=', 'licenses.buyer_id')
            ->search()
            ->orderBy('users.name')
            ->orderBy('buy_date')
            ->get();

        $billData = [];
        foreach ($bills as $bill) {
            $eachData = [$bill->buyer->name, $bill->buyer->mobile_no, $bill->amount, $bill->software->software_name, $bill->buy_dates, $bill->expiry_dates, $bill->transaction_id];
            array_push($billData, $eachData);
        }
        $emails = License::with('buyer')->join('users', 'users.id', '=', 'licenses.buyer_id')->orderBy('users.name')->get()->keyBy('buyer_id');
        return view('layouts.Biiling.index', compact(['billData', 'emails']));
    }
}
