@extends('layouts.app')

@section('title')
Dashboard | LicenseIt
@endsection

@section('content')
@include('layouts.partials._sidebar')
<div class="container container-sidebar container-birds p-0">
    <div class="d-flex flex-row justify-content-between">
        <div class="container d-flex">
            <div class="welcome d-flex">
                <div class="name">
                    <h4 class="text-hblack p-0 m-0"><strong class="p-0">Welcome Back,</strong></h4>
                    <p class="text-hblack p-0 m-0"><strong class="p-0">{{auth()->user()->name}} 👋</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section number-of-users-software reveal mt-0">
        <div class="d-flex flex-column">
            <div class="section d-flex flex-column align-items-center mb-0">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Users And Software</h2>
            </div>
            <div class="d-flex flex-row justify-content-around mb-3 mt-3 ml-5 section-divider my-card my-card-border">
                <div
                    class="p-2
                    rounded d-flex flex-column align-items-center">
                    <div class="font-weight-bolder text-hblack mb-4"> We have a total of <h3 class="text-orange d-inline h3-responsive">{{$numberOfUsers}}</h3> users enrolled.</div>
                    <div class="circle @if($numberOfUsers > $numberOfProducts) circle-more @else circle-less @endif"><h1 class="">{{$numberOfUsers}} <span class="">Users</span></h1></div>
                </div>
                <div
                    class="p-2
                    rounded d-flex flex-column align-items-center ">
                    <div class="font-weight-bolder text-hblack mb-4"> We have a total of <h3 class="text-orange d-inline h3-responsive">{{$numberOfProducts}}</h3> software license </div>
                    <div class="circle @if($numberOfUsers < $numberOfProducts) circle-more @else circle-less @endif"><h1 class="">{{$numberOfProducts}} <span class="">Products</span></h1></div>
                </div>
            </div>
        </div>
    </div>

    <div class="section ActiveStatusAndExpiryAnalysis reveal">
        <div class="d-flex flex-column ">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Active And Expire Analysis</h2>
            </div>
            <div class="d-flex flex-column mb-3 ml-5 my-card my-card-border section-divider align-items-center">
                <div class="content d-flex flex-column col-md-11">
                    <div class="d-flex flex-row justify-content-around">
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Analyze
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-orange">
                                    Plan
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Strategize
                            </strong>
                        </h1>
                    </div>

                    <div class="d-flex flex-row justify-content-between section-divider w-100 mt-2">
                        <div class="col-md-5 m-auto">
                            <div class="font-weight-bolder text-hblack mb-2"> We have a total of <h3 class="text-orange d-inline h3-responsive">{{$totalActiveUsers+$totalInActiveUsers}}</h3> users enrolled.</div>
                            <canvas id="activeStatusAnalysisChart" width="250" height="250"></canvas>
                        </div>
                        <div class="col-md-5 m-auto">
                            <div class="font-weight-bolder text-hblack mb-2"> We have a total of <h3 class="text-orange d-inline h3-responsive">{{$totalLicensesUnExpired+$totalLicensesExpired}}</h3> licenses licensed.</div>
                            <canvas id="licenseAnalysisChart" width="250" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section oneFinancialYearSalesAnalysis reveal">
        <div class="d-flex flex-column ">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Sales Analysis</h2>
            </div>
            <div class="d-flex flex-column mb-3 ml-5 my-card my-card-border section-divider align-items-center">
                <div class="content d-flex flex-column col-md-11">
                    <div class="d-flex flex-row justify-content-around">
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Last
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-orange">
                                    Year
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Sales
                            </strong>
                        </h1>
                    </div>

                    <div class="d-flex flex-row justify-content-around col-md-12">
                        <div class="font-weight-bolder text-hblack"> We have a total of <h3 class="text-orange d-inline h3-responsive">{{$licenseSoldByMonth["total"]}}</h3> licenses sold in the financial year <h3 class="text-orange d-inline h3-responsive">{{$year1}} - {{$year2}}</h3></div>
                    </div>
                    <div class="d-flex flex-row justify-content-between w-100">
                        <div class="col-md-11 m-auto">
                            <canvas id="oneYearSalesAnalysisChart" width="500" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section maxSalesByAnalysis reveal">
        <div class="d-flex flex-column ">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Buyer Analysis</h2>
            </div>
            <div class="d-flex flex-column mb-3 ml-5 my-card my-card-border section-divider align-items-center">
                <div class="content d-flex flex-column col-md-11">
                    <div class="d-flex flex-row justify-content-around">
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Maximum
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-orange">
                                    Licenses
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Purchased
                            </strong>
                        </h1>
                        <h1 class="h1-responsive">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    By
                            </strong>
                        </h1>
                    </div>

                    <div class="d-flex flex-row justify-content-around col-md-12">
                        <div class="font-weight-bolder text-hblack"> Maximum License Purchased By <h3 class="text-orange d-inline h3-responsive">{{$maxLicenseBoughtBy[0]['buyer']['name']}}</h3> Total Of <h3 class="text-orange d-inline">{{$maxLicenseBoughtBy[0]['total']}}</h3></div>
                    </div>
                    <div class="d-flex flex-row justify-content-between w-100">
                        <div class="col-md-11 m-auto">
                            <canvas id="maxSalesAnalysisChart" width="500" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')
<script>
	VANTA.BIRDS({
        el: ".container-birds",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        backgroundColor: 0xffffffff,
        color1: 0x0,
        color2: 0xffffff,
        colorMode: "lerpGradient",
        birdSize: 0.20,
        wingSpan: 5.00,
        separation: 100.00,
        backgroundAlpha: 0.5
        })
</script>
<script>
    new RevealScroll($(".reveal"), "60%");
</script>
<script>

    var ctx = document.getElementById('activeStatusAnalysisChart');
    let activeUsers = {{ $totalActiveUsers }};
    let inactiveUsers = {{ $totalInActiveUsers }};

var activeStatusAnalysisChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['InActive Users', 'Active Users'],
        datasets: [{
            label: '# of Votes',
            data: [ inactiveUsers, activeUsers],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(0, 255, 0, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(0, 255, 0, 1)',
            ],
            borderWidth: 1,
            animateScale: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var ltx = document.getElementById('licenseAnalysisChart');
    let licenseUnExpired = {{ $totalLicensesUnExpired }};
    let licenseExpired = {{ $totalLicensesExpired }};

var licenseAnalysisChart = new Chart(ltx, {
    type: 'pie',
    data: {
        labels: ['Licenses Expired', 'Licenses UnExpired'],
        datasets: [{
            label: '# of Votes',
            data: [licenseExpired , licenseUnExpired],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(0, 255, 0, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(0, 255, 0, 1)',
            ],
            borderWidth: 1,
            animateScale: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var ytx = document.getElementById('oneYearSalesAnalysisChart');
let year1 = {{$year1}};
let year2 = {{$year2}};
var monthWiseSales = [];
monthWiseSales.push({{$licenseSoldByMonth['april']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['may']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['june']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['july']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['august']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['september']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['october']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['november']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['december']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['january']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['february']->count()}});
monthWiseSales.push({{$licenseSoldByMonth['march']->count()}});


const labels = ['April' + year1, 'May' + year1, 'June' + year1, 'July' + year1, 'August' + year1, 'September' + year1, 'October' + year1, 'November' + year1, 'December' + year1, 'January' + year2, 'February' + year2, 'March' + year2];
var oneYearSalesAnalysis = new Chart(ytx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Licenses Sold',
            data: monthWiseSales,
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            animateScale: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var btx = document.getElementById('maxSalesAnalysisChart');
    const labels_sales = ["{{$maxLicenseBoughtBy[0]['buyer']['name']}}", "{{$maxLicenseBoughtBy[1]['buyer']['name']}}", "{{$maxLicenseBoughtBy[2]['buyer']['name']}}", "{{$maxLicenseBoughtBy[3]['buyer']['name']}}", "{{$maxLicenseBoughtBy[4]['buyer']['name']}}"];
    const values = [{{$maxLicenseBoughtBy[0]['total']}}, {{$maxLicenseBoughtBy[1]['total']}}, {{$maxLicenseBoughtBy[2]['total']}}, {{$maxLicenseBoughtBy[3]['total']}}, {{$maxLicenseBoughtBy[4]['total']}}];
var maxSalesAnalysisChart = new Chart(btx, {
    type: 'bar',
    data: {
        labels: labels_sales,
        datasets: [{
            label: 'License Purchased',
            data: values,
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(54, 162, 235)',
            'rgb(75, 192, 192)',
            'rgb(201, 203, 207)'
            ],
            borderWidth: 1,
            animateScale: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>
@endsection
