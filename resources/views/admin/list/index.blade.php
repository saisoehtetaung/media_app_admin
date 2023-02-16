@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin List Page</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin#listSearch') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="adminSearchKey" class="form-control float-right"
                                    placeholder="Search" value="{{ old('adminSearchKey') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if (Session::has('deleteSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userDatas as $userData)
                                <tr>
                                    <td>{{ $userData->id }}</td>
                                    <td>{{ $userData->name }}</td>
                                    <td>{{ $userData->email }}</td>
                                    <td>{{ $userData->phone }}</td>
                                    <td>{{ $userData->address }}</td>
                                    <td>{{ $userData->gender }}</td>
                                    <td>
                                        {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                                        @if (Auth::user()->id != $userData->id)
                                            <a
                                                href="{{ count($userDatas) == 1 ? '#' : route('admin#deleteAccount', $userData->id) }}">
                                                <button class="btn btn-sm bg-danger text-white"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
