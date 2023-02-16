@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trend Post List Page</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Post Title</th>
                                <th>Image</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($viewPosts as $viewPost)
                                <tr>
                                    <td>{{ $viewPost->post_id }}</td>
                                    <td>{{ $viewPost->title }} </td>
                                    <td>
                                        <img class="rounded shadow" width="100px"
                                            @if ($viewPost->image == null) src="{{ asset('default/default_img.webp') }}" @else src="{{ asset('postImage/' . $viewPost->image) }}" @endif />
                                    </td>
                                    <td><i class="fas fa-eye"></i>{{ $viewPost->post_count }}</td>

                                    <td>
                                        <a href="{{ route('admin#trendPostDetails', $viewPost->post_id) }}"
                                            class="btn btn-sm bg-dark text-white"><i class="far fa-file-alt"></i></a>
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
