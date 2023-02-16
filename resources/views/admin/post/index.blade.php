@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-4">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin#createPost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="postTitle" class="form-control" placeholder="Enter Post Title"
                                value="{{ old('postTitle') }}" />
                            @error('postTitle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="10" name="postDescription" class="form-control" placeholder="Enter Description">{{ old('postDescription') }}</textarea>
                            @error('postDescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="postImage" class="form-control" placeholder="Enter Post Title" />
                            @error('postImage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="postCategory" class="form-control">
                                <option disabled selected>Choose Category...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('postImage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-8">
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('deleteSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post List Page</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin#categorySearch') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="searchKey" class="form-control float-right"
                                    placeholder="Search">

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
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>Post ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->post_id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        @if ($post->image == null)
                                            <img src="{{ asset('default/default_img.webp') }}" height="200px"
                                                class="rounded shadow" />
                                        @else
                                            <img src="{{ asset('/postImage/' . $post->image) }}" height="200px"
                                                class="rounded shadow" />
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin#updatePostPage', $post->post_id) }}">
                                            <button class="btn btn-sm bg-dark text-white"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('admin#deletePost', $post->post_id) }}">
                                            <button class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </a>
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
