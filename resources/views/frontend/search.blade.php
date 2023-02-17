@extends('frontend.layouts.app')
@section('content')
    <!--section-heading-->
    <div class="section-heading ">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title text-left">
                            <h2>Search resultats for : {{ $search_query }}</h2>
                            <p class="desc">{{ $count }} Articles were found for keyword <strong>
                                    {{ $search_query }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--blog-layout-1-->
    <div class="blog-search">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 oredoo-content">
                    <div class="theiaStickySidebar">
                        @forelse ($search_data as $data)
                            <!--Post1-->
                            <div class="post-list post-list-style1 pt-0">
                                <div class="post-list-image">
                                    <a href="post-single.html">
                                        <img src="{{ asset('upload/post_thumbnail') }}/{{ $data->post_thumbnail }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="post-list-title">
                                    <div class="entry-title">
                                        <h5>
                                            <a href="post-single.html">{{ $data->post_title }} </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="post-list-category">
                                    <div class="entry-cat">
                                        <a href="blog-layout-1.html"
                                            class="category-style-1">{{ $data->categoryRelation->category_name }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h2 class="text-center text-danger">Nothing for this keyword!</h2>
                        @endforelse

                        <!--pagination-->
                        {{ $search_data->links('vendor.pagination.custom') }}
                        {{-- <div class="pagination">
                            <div class="pagination-area">
                                <div class="row">
                                    <div class="col-lg-12">
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
                                </div>
                            </div>
                        </div> --}}
                        <!--/-->
                    </div>
                </div>

                <!--sidebar-->
                <div class="col-lg-4 oredoo-sidebar">
                    <div class="theiaStickySidebar">
                        <div class="sidebar">
                            <!--search-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>Search</h5>
                                </div>
                                <div class=" widget-search">
                                    <form action="search.html">
                                        <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                        <a href="search.html" class="btn-submit"><i class="las la-search"></i></a>
                                    </form>
                                </div>
                            </div>

                            <!--categories-->
                            <div class="widget ">
                                <div class="widget-title">
                                    <h5>Categories</h5>
                                </div>
                                <div class="widget-categories">
                                    @forelse ($categories as $category)
                                        <a class="category-item" href="#">
                                            <div class="image">
                                                <img src="{{ asset('upload/category_image') }}/{{ $category->category_image }}" alt="">
                                            </div>
                                            <p>{{ $category->category_name }} </p>
                                        </a>
                                    @empty
                                        <h4 class="text-center text-danger">No category found!</h4>
                                    @endforelse


                                </div>
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
                                        <button class="btn-custom" type="submit">
                                            Subscribe now

                                        </button>
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
                                            <p>Facebook 12k</p>
                                        </div>

                                        <div class="item color-instagram">
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <p>instagram 102k</p>
                                        </div>

                                        <div class="item color-twitter">
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <p>twitter 22k</p>
                                        </div>

                                        <div class="item color-youtube">
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                            <p>Youtube 120k</p>
                                        </div>

                                        <div class="item color-dribbble">
                                            <a href="#"><i class="fab fa-dribbble"></i></a>
                                            <p>dribbble 17k</p>
                                        </div>

                                        <div class="item color-pinterest">
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <p>pinterest 10k</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Tags-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>Tags</h5>
                                </div>
                                <div class="tags">
                                    <ul class="list-inline">
                                        @forelse ($tags as $tag)
                                        <li>
                                            <a href="#">{{ $tag->tag_name }}</a>
                                        </li>     
                                        @empty
                                            <h3 class="text-danger text-center">No tag found!</h3>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            <!--popular-posts-->
                            <div class="widget">
                                <div class="widget-title">
                                    <h5>popular Posts</h5>
                                </div>
                                <ul class="widget-popular-posts">
                                    <!--post1-->
                                    @forelse ($posts as $post)    
                                    <li class="small-post">
                                        <div class="small-post-image">
                                            <a href="post-single.html">
                                                <img src="{{ asset('upload/post_thumbnail') }}/{{ $post->post_thumbnail }}" alt="">
                                                <small class="nb">{{ $loop->iteration }}</small>
                                            </a>
                                        </div>
                                        <div class="small-post-content">
                                            <p>
                                                <a href="post-single.html">{{ $post->post_title }}</a>
                                            </p>
                                            <small> <span class="slash"></span> 3 mounth ago</small>

                                        </div>
                                    </li>
                                    @empty
                                        <h3 class="text-danger text-center">No pupolar post found!</h3>
                                    @endforelse
                                </ul>
                            </div>

                            <!--Ads-->
                            <div class="widget">
                                <div class="widget-ads">
                                    <img src="assets/img/ads/ads2.jpg" alt="">
                                </div>
                            </div>
                            <!--/-->
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </div>



    <!--instagram-->
    <div class="instagram">
        <div class="container-fluid">
            <div class="instagram-area">
                <div class="instagram-list">
                    <div class="instagram-item">
                        <a href="#">
                            <img src="assets/img/instagram/1.jpg" alt="">
                            <div class="icon">
                                <i class="lab la-instagram"></i>
                            </div>
                        </a>
                    </div>

                    <div class="instagram-item">
                        <a href="#">
                            <img src="assets/img/instagram/2.jpg" alt="">
                            <div class="icon">
                                <i class="lab la-instagram"></i>
                            </div>
                        </a>
                    </div>
                    <div class="instagram-item">
                        <a href="#">
                            <img src="assets/img/instagram/3.jpg" alt="">
                            <div class="icon">
                                <i class="lab la-instagram"></i>
                            </div>
                        </a>
                    </div>
                    <div class="instagram-item">
                        <a href="#">
                            <img src="assets/img/instagram/4.jpg" alt="">
                            <div class="icon">
                                <i class="lab la-instagram"></i>
                            </div>
                        </a>
                    </div>
                    <div class="instagram-item">
                        <a href="#">
                            <img src="assets/img/instagram/5.jpg" alt="">
                            <div class="icon">
                                <i class="lab la-instagram"></i>
                            </div>
                        </a>
                    </div>
                    <div class="instagram-item">
                        <a href="#">
                            <img src="assets/img/instagram/6.jpg" alt="">
                            <div class="icon">
                                <i class="lab la-instagram"></i>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
