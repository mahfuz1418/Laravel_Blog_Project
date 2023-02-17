@extends('layouts.app')
@section('content')
    {{--  START TABLE --}}
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Parent Category</h6>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Trash
                        </button>
                    </div>

                    <!-- Modal Start-->

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Trash bin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>First Name</th>
                                                    <th>LAST NAME</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($trashcategories as $trashcategory)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</th>
                                                        <td>{{ $trashcategory->category_name }}</td>
                                                        <td>{{ $trashcategory->category_slug }}</td>
                                                        <td>
                                                            <a href="{{ route('category.restore', ['id' => $trashcategory->id]) }}"
                                                                class="btn btn-warning btn-sm">Restore</a>
                                                            <form
                                                                action="{{ route('category.delete', ['id' => $trashcategory->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm detete">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr scope="row">
                                                        <td colspan="50" class="text-center">
                                                            <p class="text-danger font-weight-bold">No Data</p>
                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end  -->

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $categories->firstItem() + $loop->index }}</th>
                                        <td> <a
                                                href="{{ route('category.show', ['category' => $category->id]) }}">{{ $category->category_name }}</a>
                                        </td>
                                        <td>{{ $category->category_slug }}</td>
                                        <td>
                                            <p
                                                class="badge @if ($category->category_status == 'active') badge-success
                                        @else
                                        badge-warning @endif">
                                                {{ $category->category_status }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm detete">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr scope="row">
                                        <td colspan="50" class="text-center">
                                            <p class="text-danger font-weight-bold">No Data</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sub category start -->
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Subcategory</h6>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModals">
                            Trash
                        </button>
                    </div>

                    <!-- Modal Start-->

                    <div class="modal fade" id="exampleModals" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Trash bin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Name</th>
                                                    <th>Category Slug</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($trashsubcategories as $trassubhcategory)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</th>
                                                        <td>{{ $trassubhcategory->subcategory_name }}</td>
                                                        <td>{{ $trassubhcategory->subcategory_slug }}</td>
                                                        <td>
                                                            <a href="{{ route('subcategory.restore', ['id' => $trassubhcategory->id]) }}"
                                                                class="btn btn-warning btn-sm">Restore</a>
                                                            <form
                                                                action="{{ route('subcategory.delete', ['id' => $trassubhcategory->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm detete">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr scope="row">
                                                        <td colspan="50" class="text-center">
                                                            <p class="text-danger font-weight-bold">No Data</p>
                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SubCategory Name</th>
                                    <th>SubCategory Slug</th>
                                    <th>Parent ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategories->firstItem() + $loop->index }}</th>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->subcategory_slug }}</td>
                                        <td>{{ $subcategory->CategoryRelation->category_name }}</td>
                                        <td>
                                            <p
                                                class="badge @if ($subcategory->subcategory_status == 'active') badge-success
                                        @else
                                        badge-warning @endif">
                                                {{ $subcategory->subcategory_status }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', ['category' => $subcategory->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <a href="{{ route('subcategory.destroy', ['id' => $subcategory->id]) }}"
                                                class="btn btn-danger btn-sm">Delete</a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr scope="row">
                                        <td colspan="50" class="text-center">
                                            <p class="text-danger font-weight-bold">No Data</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                        {{ $subcategories->links() }}
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
