<?php

namespace App\Http\Controllers;

use App\Http\Requests\License\CreateLicenseRequest;
use App\Http\Requests\License\UpdateLicenseRequest;
use App\Models\License;
use App\Models\Software;
use App\Models\User;
use DateTime;
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
        $buyers = User::where('role', 0)->get();
        $buyersArray = [];
        foreach ($buyers as $buyer) {
            array_push($buyersArray, [$buyer->id, $buyer->name, $buyer->email]);
        }
        $softwares = Software::all();
        return view('layouts.License.create', compact(['buyers', 'softwares', 'buyersArray']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLicenseRequest $request)
    {
        if ($request->buyer_id == 1) {
            session()->flash('error', "Some Fishing Occurred, Please Retry");
            return redirect()->back();
        }
        License::create([
            'software_id' => $request->software_id,
            'buyer_id' => $request->buyer_id,
            'buy_date' => new DateTime($request->buy_date),
            'hardware_id' => $request->hardware_id,
            'activation_code' => $request->activation_code,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'notes' => $request->notes,
            'active' => 1
        ]);
        $buyer_name = User::where('id', $request->buyer_id)->first();
        $buyer_name = $buyer_name->name;
        $software_name = Software::where('id', $request->software_id)->first();
        $software_name = $software_name->software_name;
        session()->flash('success', "New License Allocated To $buyer_name for the $software_name Software");
        return redirect(route('licenses.index'));
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
        $buyers = User::where('role', 0)->get();
        $buyersArray = [];
        foreach ($buyers as $buyer) {
            array_push($buyersArray, [$buyer->id, $buyer->name, $buyer->email]);
        }
        $softwares = Software::all();
        return view('layouts.License.edit', compact(['license', 'buyers', 'softwares', 'buyersArray']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLicenseRequest $request, License $license)
    {
        $license->update([
            'software_id' => $request->software_id,
            'buyer_id' => $request->buyer_id,
            'buy_date' => new DateTime($request->buy_date),
            'hardware_id' => $request->hardware_id,
            'activation_code' => $request->activation_code,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'notes' => $request->notes,
            'active' => 1
        ]);
        $name = $license->buyer->name;
        $softwareName = $license->software->software_name;
        session()->flash('success', "License Bought By $name For $softwareName Software Is Updated");
        return redirect(route('licenses.index'));
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
            $eachData = [$bill->buyer->name, $bill->buyer->company_id, $bill->buyer->mobile_no, $bill->amount, $bill->software->software_name, $bill->buy_dates, $bill->expiry_dates, $bill->transaction_id];
            array_push($billData, $eachData);
        }
        $emails = License::with('buyer')->join('users', 'users.id', '=', 'licenses.buyer_id')->orderBy('users.name')->get()->keyBy('buyer_id');
        return view('layouts.Biiling.index', compact(['billData', 'emails']));
    }
}
