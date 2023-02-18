@extends('frontend.layouts.app');
@section('content')
    <!-- blog-slider-->
    <section class="blog blog-home4 d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel">
                        @foreach ($post_sliders as $post_slider)
                            <!--post1-->
                            <div class="blog-item"
                                style="background-image: url('{{ asset('upload/post_thumbnail') }}/{{ $post_slider->post_thumbnail }}')">
                                <div class="blog-banner">
                                    <div class="post-overly">
                                        <div class="post-overly-content">
                                            <div class="d-flex">
                                                <div class="entry-cat mr-2">
                                                    <a href="blog-layout-1.html"
                                                        class="category-style-2">{{ $post_slider->categoryRelation->category_name }}</a>
                                                </div>
                                                <div class="entry-cat">
                                                    <a href="blog-layout-1.html"
                                                        class="category-style-2">{{ $post_slider->subcategoryRelation->subcategory_name }}</a>
                                                </div>
                                            </div>
                                            <h2 class="entry-title">
                                                <a href="post-single.html">{{ $post_slider->post_title }} </a>
                                            </h2>
                                            <ul class="entry-meta">
                                                <li class="post-author"> <a
                                                        href="author.html">{{ $post_slider->userRelation->name }}</a></li>
                                                <li class="post-date"> <span class="line"></span>
                                                    {{ \Carbon\Carbon::parse($post_slider->created_at)->format('M d,Y') }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top categories-->
    <div class="categories">
        <div class="container-fluid">
            <div class="categories-area">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="categories-items">
                            @foreach ($active_categories as $active_cat)
                                <a class="category-item" href="{{ route("blog", ["slug"=>$active_cat->category_slug]) }}">
                                    <div class="image">
                                        <img src="{{ asset('upload/category_image') }}/{{ $active_cat->category_image }}" alt="">
                                    </div>
                                    <p>{{ $active_cat->category_name }} <span>{{ $active_cat->postRelation->count()}}</span> </p>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent articles-->
    <section class="section-feature-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 oredoo-content">
                    <div class="theiaStickySidebar">
                        <div class="section-title">
                            <h3>recent Articles </h3>
                            <p>Discover the most outstanding articles in all topics of life.</p>
                        </div>

                        <!--post1-->
                        @forelse ($posts as $post)
                        <div class="post-list post-list-style4">
                            <div class="post-list-image">
                                <a href="post-single.html">
                                    <img src="{{ asset('upload/post_thumbnail') }}/{{ $post->post_thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <ul class="entry-meta">
                                    <li class="entry-cat">
                                        <a href="blog-layout-1.html" class="category-style-1">{{ $post->categoryRelation->category_name }}</a>
                                    </li>
                                    <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($post->created_at)->format('M d,Y') }}</li>
                                </ul>
                                <h5 class="entry-title">
                                    <a href="{{ route('showpost', ["id" => $post->id]) }}">{{ $post->post_title }}</a>
                                </h5>

                                <div class="post-btn">
                                    <a href="{{ route('showpost', ["id" => $post->id]) }}" class="btn-read-more">Continue Reading <i
                                            class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @empty
                            <h2 class="text-center text-danger">No Post Yet</h2>
                        @endforelse

                        {{ $posts->links('vendor.pagination.custom')}}

                        <!--pagination-->
                        {{-- <div class="pagination">
                            <div class="pagination-area">
                                <div class="pagination-list">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="las la-arrow-left"></i></a></li>
                                        <li><a href="#" class="active">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#"><i class="las la-arrow-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <!--Sidebar-->
                <div class="col-lg-4 oredoo-sidebar">
                    <div class="theiaStickySidebar">
                        <div class="sidebar">
                            <!--search-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>Search</h5>
                                </div>
                                <div class=" widget-search">
                                    <form action="https://oredoo.assiagroupe.net/Oredoo/search.html">
                                        <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                        <a href="search.html" class="btn-submit"><i class="las la-search"></i></a>
                                    </form>
                                </div>
                            </div>

                            <!--popular-posts-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>popular Posts</h5>
                                </div>

                                <ul class="widget-popular-posts">
                                    <!--post1-->
                                    @forelse ($popular_posts as $popular_post)    
                                    <li class="small-post">
                                        <div class="small-post-image">
                                            <a href="post-single.html">
                                                <img src="{{ asset('upload/post_thumbnail') }}/{{ $popular_post->post_thumbnail }}" alt="">
                                                <small class="nb">1</small>
                                            </a>
                                        </div>
                                        <div class="small-post-content">
                                            <p>
                                                <a href="post-single.html">{{ $popular_post->post_title }}</a>
                                            </p>
                                            <small> <span class="slash"></span>3 mounth ago</small>
                                        </div>
                                    </li>
                                    @empty
                                        <h4>No Popular Post Yet</h4>
                                    @endforelse
                                </ul>
                            </div>

                            <!--newslatter-->
                            <div class="widget widget-newsletter">
                                <h5>Subscribe To Our Newsletter</h5>
                                <p>No spam, notifications only about new products, updates.</p>
                                <form action="#" class="newslettre-form">
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email Adress"
                                                required="required">
                                        </div>
                                        <button class="btn-custom" type="submit">Subscribe now</button>
                                    </div>
                                </form>
                            </div>

                            <!--stay connected-->
                            <div class="widget ">
                                <div class="widget-title">
                                    <h5>Stay connected</h5>
                                </div>

                                <div class="widget-stay-connected">
                                    <div class="list">
                                        <div class="item color-facebook">
                                            <a href="#"><i class="fab fa-facebook"></i></a>
                                            <p>Facebook</p>
                                        </div>

                                        <div class="item color-instagram">
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <p>instagram</p>
                                        </div>

                                        <div class="item color-twitter">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <p>twitter</p>
                                        </div>

                                        <div class="item color-youtube">
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                            <p>Youtube</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Tags-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>Tags</h5>
                                </div>
                                <div class="widget-tags">
                                    <ul class="list-inline">
                                        @foreach ($tags as $tag)
                                        <li>
                                            <a href="#">{{ $tag->tag_name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </section>
@endsection
