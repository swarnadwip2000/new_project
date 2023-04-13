@extends('admin.layouts.master')
@section('title')
Demo | Create Customer
@endsection
@push('styles')
@endpush

@section('content')
<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('stuffs.index') }}">Customers</a></li>
                        <li class="breadcrumb-item active">Create Customer</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Customer</a> --}}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Create A Customer</h6>
                        <hr>
                        <div class="card border-0 border-4">
                            <div class="card-body">
                                <form action="{{ route('stuffs.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="border p-4 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Name <span style="color: red;">*</span></label>
                                                <input type="text" name="name" id="" class="form-control" value="{{ old('name') }}" placeholder="Enter Customer Name">
                                                @if($errors->has('name'))
                                                <div class="error" style="color:red;">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Email <span style="color: red;">*</span></label>
                                                <input type="text" name="email" id="" class="form-control" value="{{ old('email') }}" placeholder="Enter Customer Email">
                                                @if($errors->has('email'))
                                                <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Toll Name <span style="color: red;">*</span></label>
                                                <select name="toll" id="" class="form-control">
                                                    <option value="">Select a Name</option>
                                                    @foreach ($tolls as $toll)
                                                        <option value="{{ $toll->id }}">{{ $toll->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('toll'))
                                                <div class="error" style="color:red;">{{ $errors->first('toll') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Shift </label>
                                                <select name="shift" id="" class="form-control">
                                                    <option value="">Select a sfift</option>
                                                    @foreach ($shifts as $shift)
                                                        <option value="{{ $shift->id }}">{{ $shift->start_time }} - {{ $shift->end_time }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('shift'))
                                                <div class="error" style="color:red;">{{ $errors->first('shift') }}</div>
                                                @endif
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Password <span style="color: red;">*</span></label>
                                                <input type="password" name="password" id="" class="form-control" value="{{ old('password') }}" placeholder="Enter pasword">
                                                @if($errors->has('password'))
                                                <div class="error" style="color:red;">{{ $errors->first('password') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Confirm Password <span style="color: red;">*</span></label>
                                                <input type="password" name="confirm_password" id="" class="form-control" value="{{ old('confirm_password') }}">
                                                @if($errors->has('confirm_password'))
                                                <div class="error" style="color:red;">{{ $errors->first('confirm_password') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Status <span style="color: red;">*</span></label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="">Select a Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @if($errors->has('status'))
                                                <div class="error" style="color:red;">{{ $errors->first('status') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEnterYourName" class="col-form-label"> Profile Picture <span style="color: red;">*</span></label>
                                                <input type="file" name="profile_picture" id="" class="form-control" value="{{ old('profile_picture') }}">
                                                @if($errors->has('profile_picture'))
                                                <div class="error" style="color:red;">{{ $errors->first('profile_picture') }}</div>
                                                @endif
                                            </div>
                                        <div class="row" style="margin-top: 20px; float: left;">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn px-5 submit-btn">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')

@endpush