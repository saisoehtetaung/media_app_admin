@extends('admin.layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="offset-4 col-4">
            <h2>Category Update Page</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin#categoryUpdate') }}" method="post">
                        @csrf
                        <input type="hidden" name="categoryId" class="form-control" value="{{ $data->category_id }}" />
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="categoryName" class="form-control" placeholder="Enter Category Name"
                                value="{{ $data->title }}" />
                            @error('categoryName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="10" name="categoryDescription" class="form-control" placeholder="Enter Description">{{ $data->description }}</textarea>
                            @error('categoryDescription')
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
