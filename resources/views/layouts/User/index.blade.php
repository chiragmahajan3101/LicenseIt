@extends('layouts.app')

@section('title')
Users | LicenseIt
@endsection

@section('content')
@include('layouts.partials._sidebar')

<div class="container container-sidebar container-birds p-0">
    <div class="d-flex flex-row justify-content-between">
        <div class="container d-flex">
            <div class="welcome d-flex">
                <div class="name">
                    <h1 class="text-hblack p-0 m-0"><strong class="p-0">Manage Users,</strong></h1>
                    <p class="text-hblack p-0 m-0"><strong class="p-0">{{auth()->user()->name}} 👋</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-divider bills-of-license-purchased reveal mt-0">
        <div class="d-flex flex-column">
            <div class="section d-flex flex-column align-items-center mb-0">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">User Registered Details</h2>
            </div>
            <div class="d-flex flex-column justify-content-around mb-3 mt-3 ml-5 section-divider my-card my-card-border">

                <div class="d-flex flex-row section-divider justify-content-center mb-4 border border-light shadow-sm p-3">
                    <form action="{{ route('users.index') }}" method="GET" class="d-inline col-md-9">
                        <select class="custom-select col-md-8" name="email">
                            <option selected>@if(request('email')) {{request('email')}} @else Select Any Email @endif</option>
                            @foreach ($emails as $emailElement)
                            <option value="{{$emailElement['email']}}">{{$emailElement['email']}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn">
                            <i class="fa fa-search"></i>
                        </button>
                        <button type="reset" value="Reset" class="btn reset">
                            Reset
                        </button>
                    </form>

                    <div class="button d-inline">
                        <a
                            href="{{ route('users.create') }}"
                            class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                            <span class="styled-button-text"><i class="fa fa-plus" ></i> Add User</span>
                        </a>
                    </div>
                </div>


                <table id="user_table_id" class="display reveal">
                    <thead>
                        <tr>
                            <th>Registered ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Licenses Bought</th>
                            <th>Action</th>
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
    var datas = @json($usersData);

    $(document).ready( function () {
        $('#user_table_id').DataTable({
            data:datas,
            scrollY: 400,
        });
    } );

    $(".reset").click(function() {
        location.href = "/users";
    });
</script>
@endsection
