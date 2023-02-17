@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Posts</h6>
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
                                                    <th>Post Title</th>
                                                    <th>Post Kind</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($trushposts as $trushpost)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</th>
                                                        <td>{{ $trushpost->post_title }}</td>
                                                        <td>{{ $trushpost->post_kind }}</td>
                                                        <td>
                                                            <a href="{{ route('post.restore', ['id' => $trushpost->id]) }}"
                                                                class="btn btn-warning btn-sm">Restore</a>
                                                            <form
                                                                action="{{ route('post.delete', ['id' => $trushpost->id]) }}"
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
                                    <th>Post Title</th>
                                    <th>Post Category</th>
                                    <th>Post Subcategory</th>
                                    <th>Post Type</th>
                                    <th>Post Kind</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</th>
                                        <td>{{ $post->post_title }}</td>
                                        <td>{{ $post->categoryRelation->category_name }}</td>
                                        @if ($post->post_subcategory === null)
                                            <td class="text-danger">no subcategory</td>
                                        @else    
                                        <td>{{ $post->subcategoryRelation->subcategory_name }}</td>
                                        @endif
                                        <td>
                                            <p
                                                class="badge @if ($post->post_status == 'active') badge-success
                                            @else
                                            badge-warning @endif">
                                                {{ $post->post_status }}</p>
                                        </td>
                                        <td>{{ $post->post_kind }}</td>
                                        <td>
                                            <a href="{{ route('post.edit', ['post' => $post->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('post.destroy', ['post' => $post->id]) }}"
                                                method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger btn-sm">Delete</button>
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
            </div>
        </div>
    </div>
@endsection
