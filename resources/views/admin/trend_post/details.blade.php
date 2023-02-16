@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">

        <div class="offset-4 col-4">
            <div>
                <i class="fas fa-arrow-left fs-4" onclick="history.back()"></i>
            </div>

            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-bold fs-4">Post View Info Page</h1>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="postTitle" class="form-control" placeholder="Enter Post Title"
                            value="{{ $postDetail->title }}" disabled />

                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        {{-- <textarea rows="10" name="postDescription" class="form-control" placeholder="Enter Description" disabled>{{ $postDetail->description }}</textarea>
                         --}}

                        <p>{{ $postDetail->description }}</p>

                    </div>

                    <div class="form-group">
                        <label>Image</label><br />

                        @if ($postDetail->image == null)
                            <img src="{{ asset('default/default_img.webp') }}" height="200px" class="rounded shadow mt-2" />
                        @else
                            <img src="{{ asset('/postImage/' . $postDetail->image) }}" height="200px"
                                class="rounded shadow mt-2" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="postCategory" class="form-control" disabled>
                            <option disabled selected>Choose Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}"
                                    @if ($postDetail->category_id == $category->category_id) selected @endif>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div>
                        <label class="form-group">View Count</label>
                        <input type="text" name="postTitle" class="form-control" placeholder="Enter Post Title"
                            value="{{ count($viewPosts) }}" disabled />
                    </div>



                </div>
            </div>
        </div>

    </div>
@endsection
