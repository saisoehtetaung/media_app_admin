@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <legend class="text-center">User Profile</legend>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                @if (Session::has('updateSuccess'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ Session::get('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('admin#update') }}" method="post">
                                    @csrf
                                    <input type="hidden" class="form-control" id="" name="adminId"
                                        value="{{ $userInfo->id }}">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="adminName"
                                                placeholder="Enter Name..." value="{{ old('adminName', $userInfo->name) }}">
                                            @error('adminName')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="adminEmail"
                                                placeholder="Enter Email..."
                                                value="{{ old('adminEmail', $userInfo->email) }}">
                                            @error('adminEmail')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="adminPhone"
                                                placeholder="Enter Phone..." value="{{ $userInfo->phone }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Address</label>

                                        <div class="col-sm-10">
                                            <textarea cols="30" rows="10" class="form-control" name="adminAddress" placeholder="Enter address...">{{ $userInfo->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-sm-10">
                                            <select name="adminGender" id="" class="form-control">
                                                <option selected disabled>Choose Your Option</option>
                                                <option value="male" {{ $userInfo->gender == 'male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="female"
                                                    {{ $userInfo->gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn bg-dark text-white">Update</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
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
