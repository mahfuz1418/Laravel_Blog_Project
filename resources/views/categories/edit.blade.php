@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 grid-margin stretch-card ">
        <div class="card ">
            <div class="card-body ">
                <h6 class="card-title">Edit Categories</h6>
                
                <form class="forms-sample" action="{{ route('category.update', ['category'=>$category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Category name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputUsername2"
                                name="name" value="{{ $category->category_name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" 
                                name="slug" value="{{ $category->category_slug }}">
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="exampleInputEmail2" 
                                name="image">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9 ">
                            <select name="status" id=""> 
                                <option value="active" @selected($category->category_status == 'active')>Active</option>
                                <option value="inactive" @selected($category->category_status == 'inactive')>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Edit Category</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
@endsection