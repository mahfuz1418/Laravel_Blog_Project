@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 grid-margin stretch-card ">
        <div class="card ">
            <div class="card-body ">
                <h6 class="card-title">Create Tags</h6>
                {{-- @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>
                                <p class="text-danger">{{ $error }}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif --}}
                <form class="forms-sample" action="{{ route('tag.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tag name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputUsername2"
                                name="tag_name">
                            @error('tag_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Create Tag</button>

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