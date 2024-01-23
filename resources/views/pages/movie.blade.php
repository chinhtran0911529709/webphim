{{-- chi tiet phim --}}
@extends('layout')
@section('content') 
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{ route('category',$movie->category->slug) }}">{{ $movie->category->title }}</a> » <span><a href="{{ route('country',$movie->country->slug) }}">{{ $movie->country->title }}</a> » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            
             <div class="halim-movie-wrapper">
                <div class="title-block">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                      <div class="halim-pulse-ring"></div>
                   </div>
                   <div class="title-wrapper" style="font-weight: bold;">
                      Bookmark
                   </div>
                </div>
                <div class="movie_info col-xs-12">
                   <div class="movie-poster col-md-3">
                      <img class="movie-thumb" src="{{ asset('upload/movie/'.$movie->image) }}" alt="{{ $movie->title }}">
                      <div class="bwa-content">
                         <div class="loader"></div>
                         @if(isset($episode_tapdau) && $episode_tapdau != null)
                         <a href="{{ url('xem-phim/'.$movie->slug.'/tap-'.$episode_tapdau->episode) }}" class="bwac-btn">
                         <i class="fa fa-play"></i>
                         </a>
                         @endif
                      </div>
                   </div>
                   <div class="film-poster col-md-9">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{ $movie->title }}</h1>
                      <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                      <ul class="list-info-group">
                         <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                           @if($movie->resolution==0)
                           HD
                           @elseif($movie->resolution==1)
                           SD
                           @elseif($movie->resolution==2)
                           HDCam
                           @elseif($movie->resolution==3)
                           FullHD
                           @endif 
                              </span><span class="episode">
                                 @if($movie->phude==0)
                                 Vietsub
                                 @else
                                 Thuyết minh
                                 @endif 
                                 
                              </span></li>
                         @if($movie->session != 0)
                         <li class="list-info-group-item"><span>Session</span> : <span class="imdb">{{ $movie->session }}</span></li>
                         @endif  
                         <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li>
                         <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->thoiluong }}</li>
                         <li class="list-info-group-item"><span>Số tập phim</span> : {{ $episode_count }}/{{ $movie->sotap }}
                           @if($episode_count == $movie->sotap)
                           - Hoàn thành
                           @else
                           - Đang cập nhật
                           @endif
                        </li>
                         <li class="list-info-group-item"><span>Thể loại</span> : 
                           @foreach($movie->movie_genre as $gen) 
                              
                           <a href="{{ route('genre',$gen->slug) }}" rel="category tag">{{ $gen->title }}</a>
                              
                           @endforeach
                           
                           {{-- <a href="{{ route('genre',$movie->genre->slug) }}" rel="category tag">{{ $movie->genre->title }}</a> --}}
                         <li class="list-info-group-item"><span>Danh mục</span> : <a href="{{ route('category',$movie->category->slug) }}" rel="category tag">{{ $movie->category->title }}</a>
                         <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{ route('country',$movie->country->slug) }}" rel="tag">{{ $movie->country->title }}</a></li>
                         <li class="list-info-group-item"><span>Tập phim mới nhất</span> : 
                           @if(isset($episode) && $episode != null)
                           @foreach($episode as $ep)
                           <a href="{{ url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode)  }}"  rel="tag"> tập {{ $ep->episode }}
                           </a>
                           @endforeach
                           @else
                              Chưa có tập phim nào
                           @endif
                        </li>
                        <li class="list-info-group-item">
                           @if($thichphim == 1)
                              <a href="{{ url('delete-phimyeuthich/'.$movie->id) }}"><i class="fa-solid fa-heart fa-2xl" style="color: #c61083;"></i></a>
                           @elseif($thichphim == 0 )
                              <a href="{{ url('add-phimyeuthich/'.$movie->id) }}"><i class="fa-solid fa-heart fa-2xl" style="color: #f5f5f5;"></i></a>
                           @endif
                        </li>

                         {{-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                         <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li> --}}
                      </ul>
                      <div class="movie-trailer hidden"></div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div id="halim_trailer"></div>
             <div class="clearfix"></div>
             <div class="section-bar clearfix">
                <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
             </div>
             <div class="entry-content htmlwrap clearfix">
                <div class="video-item halim-entry-box">
                   <article id="post-38424" class="item-content">
                      {{ $movie->description }}
                   </article>
                </div>
             </div>
             {{-- Trailer phim --}}
            @if($movie->trailer != null)
            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">trailer phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $movie->trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                  </article>
               </div>
            </div>
            @endif
            {{-- test link phim --}}
            {{-- <iframe width="100%" height="315" src="https://kd.opstream3.com/share/cfb8a1d29fd07f8e0e2ab2ffee176eb1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
            

             {{-- tags phim --}}
            <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     @php 
                     $tags = array();
                     $tags = explode(',',$movie->tags);
                     // print_r($tags);
                     @endphp
                     @foreach($tags as $key => $tag)
                     <a href="{{ route('tag-movie',$tag) }}">{{ $tag }}</a>
                     
                     <br>
                     @endforeach
                  </article>
               </div>
            </div>
             {{-- tags phim --}}
             {{-- lay url duong dan hien tai --}}
             
             <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Bình Luận</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     <?php
                     $url = Request::url();
                     ?>
                     <div class="fb-comments" data-href="{{ $url }}" data-width="100%" data-numposts="10" 	
                     data-colorscheme = "light" style="background-color:white"></div>
                  </article>
               </div>
            </div>
            
         </div>
       </section>
      <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach($movie_related as $key => $related)
                <article class="thumb grid-item post-38498">
                   <div class="halim-item">
                      <a class="halim-thumb" href="{{ route('movie',$related->slug) }}" title="{{ $related->title }}">
                         <figure><img class="lazy img-responsive" src="{{ asset('upload/movie/'.$related->image) }}" alt="{{ $related->title }}" title="{{ $related->title }}"></figure>
                         <span class="status">
                           @if($related->resolution==0)
                           HD
                           @elseif($related->resolution==1)
                           SD
                           @elseif($related->resolution==2)
                           HDCam
                           @elseif($related->resolution==3)
                           FullHD
                           @endif      
                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                           @if($related->phude==0)
                           Vietsub
                           @else
                           Thuyết minh
                           @endif 
                        </span> 
                         <div class="icon_overlay"></div>
                         <div class="halim-post-title-box">
                            <div class="halim-post-title ">
                               <p class="entry-title">{{ $related->title }}</p>
                               <p class="original_title">{{ $related->name_eng }}</p>
                            </div>
                         </div>
                      </a>
                   </div>
                </article>
               @endforeach
               
            </div>
            <script>
                jQuery(document).ready(function($) {				
                var owl = $('#halim_related_movies-2');
                owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
             </script>
         </div>
      </section>
    </main>
    @include('pages.include.sidebar')
</div>
@endsection