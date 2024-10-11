@extends('frontend.master')
@section('content')
  <!--section-heading-->
  <div class="section-heading " >
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title text-left">
                        <h2>Search resultats for : {{ @$_GET['search_key'] }}</h2>
                        <p class="desc">{{ $search_post->count() }} Articles were found for keyword  <strong>{{ @$_GET['search_key'] }}</strong></p>
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
                 <!--Post1-->
                 @forelse ($search_post as $search_post)
                <div class="post-list post-list-style1 pt-0">
                    <div class="post-list-image">
                        <a href="{{ route('post.details',$search_post->slug) }}">
                            <img src="{{ asset('uploads/post/thumbnail') }}/{{ $search_post->thumbnail }}" alt="">
                        </a>
                    </div>
                    <div class="post-list-title">
                        <div class="entry-title">
                            <h5>
                                <a href="{{ route('post.details',$search_post->slug) }}">{{ $search_post->title }} </a>
                            </h5>
                        </div>
                    </div>
                    <div class="post-list-category">
                        <div class="entry-cat">
                            <a href="{{ route('category.post',$search_post->category_id) }}" class="category-style-1">{{ $search_post->cat_relation->category_name   }} </a>
                        </div>
                    </div>
                </div>
                @empty
                 <h1>No Search Result Found</h1>
                @endforelse
                <!--pagination-->
                 <div class="pagination">
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
                                <form >
                                    <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                    <a  class="btn-submit"><i class="las la-search"></i></a>
                                </form>
                            </div>
                        </div>

                       <!--categories-->
                       <div class="widget ">
                        <div class="widget-title">
                            <h5>Categories</h5>
                        </div>
                        <div class="widget-categories">
                            @foreach ($categories as $category )
                            <a class="category-item" href="{{ route('category.post',$category->id) }}">
                                <div class="image">
                                    <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="">
                                </div>
                                <p>{{ $category->category_name }}</p>
                            </a>
                            @endforeach

                        </div>
                    </div>
                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
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
                            <div class="tags">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag )

                                    <li>
                                        <a href="{{ route('tag.post',$tag->id) }}">{{ $tag->tag_name }}</a>
                                    </li>
                                    @endforeach
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
                                @foreach ($popular_post as $popular_post )
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="{{ route('post.details',$popular_post->rel_to_post->slug) }}">
                                            <img src="{{asset('/uploads/post/thumbnail')}}/{{$popular_post->rel_to_post->thumbnail }}" alt="">
                                            <small class="nb">{{ $popular_post->total_count }}</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="">{{ $popular_post->rel_to_post->title }}</a>
                                        </p>
                                        <small> <span class="slash"></span>{{ $popular_post->rel_to_post->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                                @endforeach

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

@endsection
@section('footer_script')
<script>
    $('.btn-submit').click(function(){
      let search_key=$('#gsearch').val();
      let link="{{ route('search') }}"+"?search_key="+search_key;
       window.location.href=link;
    });
</script>

@endsection
