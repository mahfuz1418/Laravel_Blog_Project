@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <h6 class="card-title">CREATE A POST</h6>
                    {{-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>
                                <p class="text-danger">{{ $error }}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif --}}
                    <form class="forms-sample" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="post_title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="post_slug">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Thumbnail</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="post_thumbnail">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Parent Category</label>
                            <div class="col-sm-9">
                                <select name="post_category" id="parent_category">
                                    <option value="0">Select parent Category</option>
                                    @foreach ($parent_category as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Category</label>
                            <div class="col-sm-9">
                                <select name="post_subcategory" id="sub_category">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Status</label>
                            <div class="col-sm-9">
                                <select name="post_status" id="">
                                    <option value="active">active</option>
                                    <option value="inactive">inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Type</label>
                            <div class="col-sm-9">
                                <select name="post_type" id="">
                                    <option value="active">active</option>
                                    <option value="inactive">inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Kind</label>
                            <div class="col-sm-9">
                                <select name="post_kind" id="">
                                    <option value="top">Top</option>
                                    <option value="popular">Popular</option>
                                    <option value="trending">Trending</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tags</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-multiple" name="tags[]"  multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Description</label>
                            <div class="col-sm-9">
                                <textarea name="post_description" id="summernote" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Create Posts</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#summernote").summernote({
                placeholder: 'describe your post',
                height: 400,
            });
            $('.select_js').select2();
        });
    </script>
    <!-- ajax code -->
    <script>
        $(document).ready(function() {
            // category ajax
            $('#parent_category').change(function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/admin/post/subcategorylist',
                        data: {
                            category_id: category_id
                        },
                        success: function(data) {
                            $("#sub_category").html(data);
                        }
                    });
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
