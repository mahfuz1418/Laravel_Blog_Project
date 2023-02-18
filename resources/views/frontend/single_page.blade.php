@extends('frontend.layouts.app')
@section('content')    
<!--post-single-->
<section class="post-single">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12">
                <!--post-single-image-->
                    <div class="post-single-image">
                        <img src="{{ asset('upload/post_thumbnail') }}/{{ $single_post->post_thumbnail }}" alt="">
                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">  
                            <h2>{{ $single_post->post_title }}</h2>        
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ asset('upload/admin_profile_image') }}/{{ $single_post->userRelation->profile_image }}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{ $single_post->userRelation->name }}</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{ $single_post->categoryRelation->category_name }}</a></li>
                                <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($single_post->created_at)->format('M d,Y') }}</li>
                            </ul>
                            
                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            {{ $single_post->post_description }}
                            {{-- <p>
                                Its sometimes her behaviour are contented. Do listening am eagerness oh objection collected. Together gay feelings continue
                                juvenile had off Unknown may service 
                                subject her letters one bed. Child years noise ye in forty. Loud in this in both
                                hold. My entrance me is disposal bachelor remember relation
                            </p>
                            <h4> Make it simple, but significant. </h4>

                            <p>
                                Oh acceptance apartments up sympathize astonished delightful. Waiting him new lasting towards. Continuing melancholy especially
                                so to. Me unpleasing  impossible in attachment announcing so astonished. What ask leaf may nor upon door. Tended remain
                                my do stairs. Oh smiling amiable am so visited cordial in offices hearted.
                            </p>
                        
                            <p>
                                Oh acceptance apartments up sympathize astonished delightful. Waiting him new lasting towards. Continuing melancholy especially
                                so to. Me unpleasing impossible in attachment announcing so astonished. What ask leaf may nor upon door. Tended remain
                                my do stairs. Oh smiling amiable am so visited cordial in offices hearted.
                                    Oh acceptance apartments up sympathize astonished delightful. Waiting him new lasting towards. Continuing melancholy especially
                                so to. Me unpleasing impossible in attachment announcing so astonished. What ask leaf may nor upon door. Tended remain my
                                do stairs. Oh smiling amiable am so visited cordial in offices hearted.
                                    Waiting him new lasting towards. Continuing melancholy especially so to. Me unpleasing impossible in attachment announcing
                                so astonished. What ask leaf may nor upon door. Tended remain my do stairs.
                                
                            Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                                in culpa qui officia
                                deserunt mollit anim id est laborum.
                            </p>
                            <h4>  Simplicity is the ultimate sophistication</h4>
                        
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                cupidatat non proident.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                non proident.
                            </p> --}}
                            <div class="image-groupe">
                                <div class="image">
                                    <img src="assets/img/blog/25.jpg" alt="">
                            
                                </div>
                                <div class="image">
                                    <img src="assets/img/blog/21.jpg" alt="">
                                    
                                </div>
                            </div>
                    
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                irure dolor Unknown may service in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                cupidatat non proident.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor Unknown may service in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                                occaecat cupidatat non proident.
                            </p>
                            
                        </div>
                        
                        <!--post-single-bottom-->
                        <div class="post-single-bottom"> 
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
                                    <li >
                                        <a href="blog-layout-2.html">brading</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-2.html">marketing</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-3.html">tips</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-4.html">design</a>
                                    </li>
                                    <li >
                                        <a href="blog-layout-5.html">business
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>                      
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="author.html" class="image">
                                        <img src="assets/img/author/1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>sarah smith</h4>
                                    <p> Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                                        Quis sem justo nisi varius.
                                    </p>
                                    <div class="social-media">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" >
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" >
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        
                        <!--post-single-comments-->
                        <div class="post-single-comments">
                            <!--Comments-->
                            <h4 >3 Comments</h4>
                            <ul class="comments">
                                <!--comment1-->
                                <li class="comment-item pt-0">
                                    <img src="assets/img/other/user1.jpg" alt="">
                                    <div class="content">
                                        <div class="meta">
                                            <ul class="list-inline">
                                                <li><a href="#">Nirmaine Nicole</a> </li>
                                                <li class="slash"></li>
                                                <li>3 Months Ago</li>
                                            </ul>
                                        </div>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus at doloremque adipisci eum placeat
                                            quod non fugiat aliquid sit similique!
                                        </p>
                                        <a href="#" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                    </div>
                            
                                </li>
                                <!--comment2-->
                                <li class="comment-item">
                                    <img src="assets/img/other/use2.jpg" alt="">
                                    <div class="content">
                                        <div class="meta">
                                            <ul class="list-inline">
                                                <li><a href="#">adam smith</a> </li>
                                                <li class="slash"></li>
                                                <li>3 Months Ago</li>
                                            </ul>
                                        </div>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus at doloremque adipisci eum placeat
                                            quod non fugiat aliquid sit similique!
                                        </p>
                                        <a href="#" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                    </div>
                                </li>
                                   <!--comment3-->
                                <li class="comment-item">
                                    <img src="assets/img/other/user3.jpg" alt="">
                                    <div class="content">
                                        <div class="meta">
                                            <ul class="list-inline">
                                                <li><a href="#">Emma david</a> </li>
                                                <li class="slash"></li>
                                                <li>3 Months Ago</li>
                                            </ul>
                                        </div>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus at doloremque adipisci eum placeat
                                            quod non fugiat aliquid sit similique!
                                        </p>
                                        <a href="#" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                    </div>
                                </li>
                            
                            </ul>
                            <!--Leave-comments-->
                            <div class="comments-form">
                                <h4 >Leave a Reply</h4>
                                <!--form-->
                                <form class="form " action="#" method="POST" id="main_contact_form">
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required="required"></textarea>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-12">
                                            <div class="mb-20">
                                                <input name="name" type="checkbox" value="1" required="required">
                                                <label for="name"><span>save my name , email and website in this browser for the next time I comment.</span></label>
                                            </div>
                                        
                                            <button type="submit" name="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div> 
                                    </div>
                                </form>
                                <!--/-->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection






   