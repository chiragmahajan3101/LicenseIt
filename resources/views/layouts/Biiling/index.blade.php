@extends('layouts.app')

@section('title')
Billing | LicenseIt
@endsection

@section('content')
@include('layouts.partials._sidebar')

<div class="container container-sidebar container-birds p-0">
    <div class="d-flex flex-row justify-content-between">
        <div class="container d-flex">
            <div class="welcome d-flex">
                <div class="name">
                    <h1 class="text-hblack p-0 m-0"><strong class="p-0">Billings,</strong></h1>
                    <p class="text-hblack p-0 m-0"><strong class="p-0">{{auth()->user()->name}} 👋</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section bills-of-license-purchased reveal mt-0">
        <div class="d-flex flex-column">
            <div class="section d-flex flex-column align-items-center mb-0">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Bills And Purchase Details</h2>
            </div>
            <div class="d-flex flex-column justify-content-around mb-3 mt-3 ml-5 section-divider my-card my-card-border">

                    <form action="{{ route('billing') }}" method="GET" class="d-flex flex-row justify-content-start col-md-10">
                        <select class="custom-select col-md-5" name="email">
                            <option selected>@if(request('email')) {{request('email')}} @else Select Any Email @endif</option>
                            @foreach ($emails as $bill)
                            <option value="{{$bill->buyer->email}}">{{$bill->buyer->email}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn">
                            <i class="fa fa-search"></i>
                        </button>
                        <button type="reset" value="Reset" class="btn reset">
                            Reset
                        </button>
                    </form>


                <table id="bill_table_id" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Mobile No</th>
                            <th>Cost</th>
                            <th>Product Name</th>
                            <th>Buy Date</th>
                            <th>Expire Date</th>
                            <th>Transaction ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    new RevealScroll($(".reveal"), "60%");
</script>
<script>
    var datas = @json($billData);

    $(document).ready( function () {
        $('#bill_table_id').DataTable({
            data:datas,
            scrollY: 400,
        });
    } );

    $(".reset").click(function() {
        location.href = "/billing";
    });
</script>
@endsection
