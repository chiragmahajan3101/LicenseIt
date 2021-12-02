@extends('layouts.app')

@section('title')
Edit License | LicenseIt
@endsection

@section('content')
@include('layouts.partials._sidebar')

<div class="container container-sidebar container-birds p-0">
    <div class="d-flex flex-row justify-content-between">
        <div class="container d-flex">
            <div class="welcome d-flex">
                <div class="name">
                    <h1 class="text-hblack p-0 m-0"><strong class="p-0">Update License,</strong></h1>
                    <p class="text-hblack p-0 m-0"><strong class="p-0">{{auth()->user()->name}} 👋</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-divider bills-of-license-purchased reveal mt-0">
        <div class="d-flex flex-column">
            <div class="section d-flex flex-column align-items-center mb-0">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Update Allocated License</h2>
            </div>
            <div class="d-flex flex-column justify-content-around mb-3 mt-3 ml-5 section-divider my-card my-card-border">
                <form action="{{ route('licenses.update', $license) }}" method="POST" id="edit-license-form" enctype="multipart/form-data" class="border border-light shadow-lg p-4">
                    @csrf
                    @method('PUT')
                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="Software">Software</label><i class="ml-2 fa fa-cogs"></i></strong>
                                <select name="software_id" id="Software" class="form-control d-inline select2">
                                    <option>Select Any Software</option>
                                    @foreach ($softwares as $software)
                                        <option value="{{$software->id}}"
                                            {{ (old('software', $license->software_id) ? 'selected' : '')}}>{{$software->software_name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('software')
                                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="Buyer">User</label><i class="ml-2 fa fa-user"></i></strong>
                                <select name="buyer_id" id="Buyer" class="form-control select2" onChange="setUser()">
                                    <option value="-1">Select Any User</option>
                                    @foreach ($buyers as $user)
                                        <option value="{{$user->id}}"
                                            {{ (old('buyer_id', $license->buyer_id) ? 'selected' : '')}}>{{$user->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('buyer_id')
                                <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <label for="Name">User Name<i class="ml-2 fa fa-user-circle"></i></label>
                                <input
                                type="text"
                                id="Name"
                                name="name"
                                value="Select Any User"
                                class="form-control @error('title') is-invalid @enderror" disabled>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label for="Email">User Email<i class="ml-2 fa fa-envelope"></i></label>
                                <input
                                type="text"
                                id="Email"
                                name="email"
                                value="Select Any User"
                                class="form-control  @error('title') is-invalid @enderror" disabled>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="buy_date">Activation Date</label><i class="ml-2 fa fa-hourglass-start"></i></strong>
                                <input type="text"
                                        class="form-control"
                                        name="buy_date"
                                        value="{{ old('buy_date', $license->buy_date) }}"
                                        id="buy_date"
                                        onchange="setDate()">
                            </div>
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="expiry_date">Expiry Date</label><i class="ml-2 fa fa-hourglass-3"></i></strong>
                                <input type="text"
                                        class="form-control"
                                        name="expiry_date"
                                        value="{{ old('expiry_date', $license->expiry_date) }}"
                                        id="expiry_date" disabled>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="hardware_id">Hardware ID</label><i class="ml-2 fa fa-desktop"></i></strong>
                                <input
                                    type="text"
                                    id="hardware_id"
                                    name="hardware_id"
                                    value="{{ old('hardware_id', $license->hardware_id) }}"
                                    placeholder="Enter Machine ID"
                                    class="form-control  @error('hardware_id') is-invalid @enderror">
                                @error('hardware_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="activation_code">Activation Code</label><i class="ml-2 fa fa-wrench"></i></strong>
                                <input
                                    type="text"
                                    id="activation_code"
                                    name="activation_code"
                                    value="{{ old('activation_code', $license->activation_code) }}"
                                    placeholder="Enter Activation Code"
                                    class="form-control  @error('activation_code') is-invalid @enderror">
                                @error('activation_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-around section-divider">
                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="amount">Cost</label><i class="ml-2 fa fa-rupee"></i></strong>
                                <input
                                    type="number"
                                    min="0"
                                    id="amount"
                                    name="amount"
                                    value="{{ old('amount', $license->amount) }}"
                                    placeholder="Enter Total Cost"
                                    class="form-control  @error('amount') is-invalid @enderror">
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-5">
                                <strong class="text-hblack"><label for="transaction_id">Transaction ID</label><i class="ml-2 fa fa-credit-card-alt"></i></strong>
                                <input
                                    type="text"
                                    id="transaction_id"
                                    name="transaction_id"
                                    value="{{ old('transaction_id', $license->transaction_id) }}"
                                    placeholder="Enter Transaction ID"
                                    class="form-control  @error('transaction_id') is-invalid @enderror">
                                @error('transaction_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="form-group col-md-10">
                                <strong class="text-hblack"><label for="notes">Notes</label></strong>
                                <textarea
                                    name="notes"
                                    id="notes"
                                    rows="4"
                                    class="form-control  @error('notes') is-invalid @enderror" >{{old('description', $license->notes)}}</textarea>
                                @error('notes')
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
        $("#edit-license-form").validate({
            rules: {
                buyer_id: {
                    required: true,
                },
                notes: {
                    required: true
                },
                transaction_id: {
                    required: true,
                },
                amount: {
                    min: 0,
                    required:true
                },
                hardware_id: {
                    required: true
                },
                activation_code: {
                    required: true
                },
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
     <script>
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#buy_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        flatpickr("#expiry_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
    <script>
        var buyerArray = @json($buyersArray);
        var user = $("#Buyer");
        var id = user.select2('val');
        var userName = $("#Name");
        var userEmail = $("#Email");
        if(parseInt(id) == -1){
            userName.val("Select Any User");
            userEmail.val("Select Any User");
        }
        console.log(id);
        buyerArray.forEach(element => {
            if(parseInt(element[0]) == parseInt(id)) {
                userName.val(element[1]);
                userEmail.val(element[2]);
            }
        });
        function setUser(){
            var user = $("#Buyer");
            var id = user.select2('val');
            var userName = $("#Name");
            var userEmail = $("#Email");
            if(parseInt(id) == -1){
                userName.val("Select Any User");
                userEmail.val("Select Any User");
            }
            console.log(id);
            buyerArray.forEach(element => {
                if(parseInt(element[0]) == parseInt(id)) {
                    userName.val(element[1]);
                    userEmail.val(element[2]);
                }
            });

        }
        function setDate() {
            flatpickr("#expiry_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: new Date(new Date($('#buy_date').val()).setFullYear(new Date().getFullYear() + 1))
        });
            // $('#expiry_date').val(new Date($('#buy_date').val()));

        }
    </script>
@endsection
