@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 grid-margin stretch-card ">
        <div class="card ">
            <div class="card-body ">
                <h6 class="card-title">Create Categories</h6>
                {{-- @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>
                                <p class="text-danger">{{ $error }}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif --}}
                <form class="forms-sample" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Category name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputUsername2"
                                name="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Category slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" 
                                name="slug">
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
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Select parent category </label>
                        <div class="col-sm-9">
                            <select name="parent_id" id="">
                                    <option value="0">Select parent category for subCategory</option>
                                @foreach ( $parent_categories  as $parent_category )
                                     <option value="{{ $parent_category->id }}">{{ $parent_category->category_name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9 ">
                            <select name="status" id=""> 
                                <option value="active">Active</option>
                                <option value="inactive" selected>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Create Category</button>

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