@extends('layouts.app')

@section('title')
Add User | LicenseIt
@endsection

@section('content')
@include('layouts.partials._sidebar')

<div class="container container-sidebar container-birds p-0">
    <div class="d-flex flex-row justify-content-between">
        <div class="container d-flex">
            <div class="welcome d-flex">
                <div class="name">
                    <h1 class="text-hblack p-0 m-0"><strong class="p-0">Add User,</strong></h1>
                    <p class="text-hblack p-0 m-0"><strong class="p-0">{{auth()->user()->name}} 👋</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-divider bills-of-license-purchased reveal mt-0">
        <div class="d-flex flex-column">
            <div class="section d-flex flex-column align-items-center mb-0">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Create New User</h2>
            </div>
            <div class="d-flex flex-column justify-content-around mb-3 mt-3 ml-5 section-divider my-card my-card-border">
                <form action="{{ route('users.store') }}" method="POST" id="create-user-form" enctype="multipart/form-data" class="border border-light shadow-lg p-4">
                    @csrf
                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <label for="Name">User Name<i class="ml-2 fa fa-user-circle"></i></label>
                                <input
                                type="text"
                                id="Name"
                                name="name"
                                placeholder="Enter Name Of The User"
                                value="{{old('name')}}"
                                class="form-control @error('title') is-invalid @enderror">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="mobile_no">Mobile No</label><i class="ml-2 fa fa-rupee"></i></strong>
                                <input
                                    type="number"
                                    min="0"
                                    id="mobile_no"
                                    name="mobile_no"
                                    value="{{ old('mobile_no') }}"
                                    placeholder="Enter Mobile Number"
                                    class="form-control  @error('mobile_no') is-invalid @enderror">
                                @error('mobile_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <label for="Email">User Email<i class="ml-2 fa fa-envelope"></i></label>
                                <input
                                type="email"
                                id="Email"
                                name="email"
                                placeholder="Enter Email Address"
                                value="{{old('email')}}"
                                class="form-control  @error('title') is-invalid @enderror">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="password">Password</label><i class="ml-2 fa fa-desktop"></i></strong>
                                <input
                                    type="text"
                                    id="password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    placeholder="Enter Password"
                                    class="form-control  @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="button d-inline form-group d-flex flex-row justify-content-center">
                            <button type="submit" class="styled-btn styled-rounded text-muted border border-dark" ><span class="styled-button-text">Submit<i class="fa fa-level-up ml-2" ></i> </span></button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
    <script>
        $("#create-user-form").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true
                },
                password: {
                    required: true,
                },
                mobile_no: {
                    min: 0,
                    maxlength:10,
                    required:true
                }
            },
            errorElement: 'p',
            errorPlacement: function(error, element) {
                if (error) {
                    error.insertAfter(element);
                    error.addClass('text-danger');
                }
            }
        });

    </script>
@endsection
