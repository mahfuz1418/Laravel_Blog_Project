@extends('layouts.app')
@section('content')
    {{--  START TABLE --}}
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('upload/category_image') }}/{{ $category->category_image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Slug</th>
                            <th scope="col">Category Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->category_slug }}</td>
                            <td><p class="badge @if ($category->category_status == 'active')
                                badge-success
                            @else
                            badge-warning
                            @endif">{{ $category->category_status }}</p></td>
                          </tr>
                        </tbody>
                      </table>
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
    @elseif(session('parent_error'))
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
                icon: 'warning',
                title: '{{ session('parent_error') }}'
            })
        </script>
    @endif
@endsection
