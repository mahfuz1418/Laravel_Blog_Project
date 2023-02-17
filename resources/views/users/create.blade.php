@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <h6 class="card-title">Create admin or writter</h6>

                    <form class="forms-sample" action="{{ route('user.create') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Name"
                                    name="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email"
                                    name="email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="exampleInputPassword2"
                                    placeholder="Password" name="password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9 ">
                                <select name="role" id="">
                                    <option value="admin">admin</option>
                                    <option value="writter" selected>writter</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Create</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  START TABLE --}}
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Admins And Writter Table </h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>LAST NAME</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user_list as $user)
                                    <tr>
                                        <td>{{ $user_list->firstItem() + $loop->index}}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <p
                                                class="badge @if ($user->role == 'admin') badge-primary
                                        @else
                                        badge-success @endif">
                                                {{ $user->role }}</p>
                                        </td>
                                        <td><button value="{{ route('user.destroy', ['id' => $user->id]) }}"
                                                class="btn btn-danger btn-sm detete">Delete</button></td>
                                    </tr>
                                @empty
                                    <tr scope="row">
                                        <td colspan="50" class="text-center">
                                            <p  class="text-danger font-weight-bold" >No Data</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                            
                        </table>
                        {{ $user_list->links() }}
                    </div>
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
