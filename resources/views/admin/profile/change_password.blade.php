@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <legend class="text-center">Change Password</legend>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                @if (Session::has('fail'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ Session::get('fail') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('admin#changePassword') }}" method="post">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="inputName" class="col-4 col-form-label text-center">Old Password</label>
                                        <div class="col-8">
                                            <input type="password" class="form-control" id="inputName" name="oldPass"
                                                placeholder="Enter Old Password...">
                                            @error('oldPass')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-4 col-form-label text-center">New Password</label>
                                        <div class="col-8">
                                            <input type="password" class="form-control" id="inputName" name="newPass"
                                                placeholder="Enter New Password...">
                                            @error('newPass')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-4 col-form-label text-center">Confirm
                                            Password</label>
                                        <div class="col-8">
                                            <input type="password" class="form-control" id="inputName" name="confirmPass"
                                                placeholder="Enter Confirm Password...">
                                            @error('confirmPass')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-4 col-sm-10">
                                            <button type="submit" class="btn bg-dark text-white">Change Password</button>
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
@endsection
