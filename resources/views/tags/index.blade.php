@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Tags</h6>
                    </div>

                    <!-- Modal Start-->


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tag Name</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $loop->iteration }}</th>
                                        <td>{{ $tag->tag_name }}</td>
                                        {{-- <td>
                                            <form action="{{ route('tag.destroy', ['tag' => $tag->id]) }}"
                                                method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td> --}}
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
