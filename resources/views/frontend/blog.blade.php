@extends('frontend.layouts.app')
@section('content')
    
   <!--section-heading-->
   <div class="section-heading " >
       <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>{{ $category_name }}</h1>
                            <p class="links"><a href="index.html">Home<i class="las la-angle-right"></i></a> Blog</p>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
   </div>

   
    <!-- Blog Layout-2-->
    <section class="blog-layout-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"> 
                    <!--post 1-->
                    @forelse ($post_lists as $post_list)        
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ asset("upload/post_thumbnail") }}/{{ $post_list->post_thumbnail }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="post-single.html">{{ $post_list->post_title }}</a>
                            </h3>  
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ asset("upload/admin_profile_image") }}/{{ $post_list->userRelation->profile_image }}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{ $post_list->userRelation->name }}</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{ $post_list->categoryRelation->category_name }}</a></li>
                                <li class="post-date"> <span class="line"></span>{{ \Carbon\Carbon::parse($post_list->created_at)->format('M d,Y') }}</li>
                            </ul>
                            <div class="post-exerpt">
                                <p>{{ Str::limit(strip_tags($post_list->post_description), '100', '...')  }}</p>
                            </div>
                            <div class="post-btn">
                                <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <h2 class="text-center text-danger my-5">No Post Yet</h2>
                    @endforelse  
                </div>
            </div>
        </div>
    </section>
    {{ $post_lists->links('vendor.pagination.custom_two')}}

   <!--pagination-->
   {{-- <div class="pagination">
        <div class="container-fluid">
            <div class="pagination-area">
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="pagination-list">
                            <ul class="list-inline">
                                <li><a href="#" ><i class="las la-arrow-left"></i></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#" ><i class="las la-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


</body>
</html>
@endsection