@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="offset-4 col-4">

            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-bold">Post Update Page</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin#updatePost', $postDetail->post_id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="postTitle" class="form-control" placeholder="Enter Post Title"
                                value="{{ old('postTitle', $postDetail->title) }}" />
                            @error('postTitle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="10" name="postDescription" class="form-control" placeholder="Enter Description">{{ old('postDescription', $postDetail->description) }}</textarea>
                            @error('postDescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="postImage" class="form-control" placeholder="Enter Post Title" />

                            @if ($postDetail->image == null)
                                <img src="{{ asset('default/default_img.webp') }}" height="200px"
                                    class="rounded shadow mt-2" />
                            @else
                                <img src="{{ asset('/postImage/' . $postDetail->image) }}" height="200px"
                                    class="rounded shadow mt-2" />
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="postCategory" class="form-control">
                                <option disabled selected>Choose Category...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}"
                                        @if ($postDetail->category_id == $category->category_id) selected @endif>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
