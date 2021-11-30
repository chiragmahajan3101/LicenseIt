@extends('layouts.app')

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
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card reveal">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?
                    {{ __('You are logged in!') }}
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?
                </div>
            </div>
            <div class="reveal section">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?
                    {{ __('You are logged in!') }}
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi doloribus quidem fugit fuga in minus tenetur quod similique voluptatibus, ipsa consectetur quae eaque libero blanditiis autem sequi voluptate consequatur exercitationem?
                </div>
            </div>
        </div>
    </div> --}}
    <div class="section number-of-users-software reveal mt-0">
        <div class="d-flex flex-column">
            <div class="section d-flex flex-column align-items-center mb-0">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Users And Software</h2>
            </div>
            <div class="d-flex flex-row justify-content-between mb-3 mt-3 ml-5 section-divider my-card my-card-border">
                <div
                    class="card p-2
                    rounded d-flex flex-column align-items-center">
                    <div class="circle">81%</div>
                </div>
                <div
                    class="card p-2
                    rounded d-flex flex-column align-items-center ">
                    <div class="circle">81%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section ActiveStatusAnalysis reveal">
        <div class="d-flex flex-column ">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Active And Inactive    Analysis</h2>
            </div>
            <div class="d-flex justify-content-between mb-3 ml-5 my-card my-card-border section-divider align-items-center">
                <div class="content d-flex flex-column col-md-6">
                    <h1>
                        <strong
                            class="font-weight-bolder text-orange">
                                Analyze
                        </strong>
                    </h1>
                    <h1>
                        <strong
                            class="font-weight-bolder text-hblack">
                                Plan
                        </strong>
                    </h1>
                    <h1>
                        <strong
                            class="font-weight-bolder text-hblack">
                                Strategize
                        </strong>
                    </h1>
                    <p class="font-italic">
                        <strong
                            class="text-hblack">
                            Analysis is the critical starting point of strategic thinking.
                        </strong>
                    </p>
                    <div class="font-weight-bolder text-hblack"> We have a total of <h3 class="text-orange d-inline">{{$totalActiveUsers+$totalInActiveUsers}}</h3> users enrolled.</div>
                </div>
                <div class="col-md-6 m-auto">
                    <canvas id="activeStatusAnalysisChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@0.5.21/dist/vanta.birds.min.js"></script>
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
</script>
@endsection
