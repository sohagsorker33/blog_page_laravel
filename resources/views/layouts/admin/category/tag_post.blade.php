@extends('frontend.master')


@section('content')
 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{$tag->tag_name }}</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a>{{$tag->tag_name }}</p>
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
                     @foreach ($tag_post as $post )
                     <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                 <img src="{{ asset('/uploads/post/thumbnail') }}/{{ $post->thumbnail }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="{{ route('post.details',$post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                   @if($post->author_relation->photo !=null)
                                      <img src="{{ asset('uploads/author') }}/{{ $post->author_relation->photo }}" alt="">

                                   @else
                                   <img src="{{ asset('frontend_asset') }}/img/author/1.jpg" alt="">
                                    @endif
                                </li>
                                <li class="post-author"> <a href="{{ route('author.post',$post->author_id) }}">{{ $post->author_relation->name }}</a></li>
                                <li class="entry-cat"> <a href="{{ route('category.post',$post->category_id) }}" > <span class="line"></span>{{$post->cat_relation->category_name}}</a></li>
                                <li class="post-date"> <span class="line"></span> {{ $post->created_at->diffForHumans() }}</li>
                            </ul>
                            <div class="post-exerpt">
                                <p>{{$post->author_relation->short_desp}}</p>
                            </div>
                            <div class="post-btn">
                                <a href="{{ route('post.details',$post->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </section>

   <!--pagination-->
   <div class="pagination">
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
</div>



@endsection

