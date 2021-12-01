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
        //
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
        //
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
            if ($bill->expiry_date < now()) {
                $expired = "<span class='text-danger'>$bill->expiry_dates</span>";
                $eachData = [$bill->buyer->name, $bill->buyer->mobile_no, $bill->amount, $bill->software->software_name, $bill->buy_dates, $expired, $bill->transaction_id];
            } else {
                $eachData = [$bill->buyer->name, $bill->buyer->mobile_no, $bill->amount, $bill->software->software_name, $bill->buy_dates, $bill->expiry_dates, $bill->transaction_id];
            }
            array_push($billData, $eachData);
        }
        $emails = License::with('buyer')->join('users', 'users.id', '=', 'licenses.buyer_id')->orderBy('users.name')->get()->keyBy('buyer_id');
        return view('layouts.Biiling.index', compact(['billData', 'emails']));
    }
}
