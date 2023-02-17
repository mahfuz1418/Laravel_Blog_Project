@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <h6 class="card-title">Edit Post</h6>
                    {{-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>
                                <p class="text-danger">{{ $error }}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif --}}
                    <form class="forms-sample" action="{{ route('post.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="post_title"
                                    value="{{ $post->post_title }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="post_slug" value="{{ $post->post_slug }}">
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
                                        <option value="{{ $category->id }}" @selected($post->post_category == $category->id)>
                                            {{ $category->category_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Category</label>
                            <div class="col-sm-9">
                                <select name="post_subcategory" id="sub_category">
                                    @if ($post->post_subcategory == null)
                                        <option value=""></option>
                                    @else                                    
                                    <option value="{{ $post->post_subcategory }}">
                                        {{ $post->subcategoryRelation->subcategory_name }}</option>                                       
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Status</label>
                            <div class="col-sm-9">
                                <select name="post_status" id="">
                                    <option value="active" @selected($post->post_status === 'active')>active</option>
                                    <option value="inactive" @selected($post->post_status === 'inactive')>inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Type</label>
                            <div class="col-sm-9">
                                <select name="post_type" id="">
                                    <option value="active" @selected($post->post_status === 'active')>active</option>
                                    <option value="inactive" @selected($post->post_status === 'inactive')>inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Kind</label>
                            <div class="col-sm-9">
                                <select name="post_kind" id="">
                                    <option value="top" @selected($post->post_kind === 'top')>Top</option>
                                    <option value="popular" @selected($post->post_kind === 'popular')>Popular</option>
                                    <option value="trending" @selected($post->post_kind === 'trending')>Trending</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tags</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @foreach($post->tagsRelation  as  $oldtag)
                                                @selected($tag->id === $oldtag->id)
                                            @endforeach    
                                        >{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Post Description</label>
                            <div class="col-sm-9">
                                <textarea name="post_description" id="summernote" class="form-control">{{ $post->post_description }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update Post</button>

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
