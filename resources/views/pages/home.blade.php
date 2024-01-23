@extends('layout')
@section('content') 
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            {{-- <div class="col-xs-12 carausel-sliderWidget">
               
               <section id="halim-advanced-widget-4">
                  <div class="section-heading">
                     <a href="danhmuc.php" title="Phim Chiếu Rạp">
                     <span class="h-text">Phim Chiếu Rạp</span>
                     </a>
                     <ul class="heading-nav pull-right hidden-xs">
                        <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>
                     </ul>
                  </div>
                  <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
                     @for ($i = 0; $i < 12; $i++)   
                     
                     <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{ route('movie') }}" title="GÓA PHỤ ĐEN">
                              <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                              <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">GÓA PHỤ ĐEN</p>
                                    <p class="original_title">Black Widow</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     @endfor
                  </div>
               </section>
               
               <div class="clearfix"></div>
            </div> --}}
            <div id="halim_related_movies-2xx" class="wrap-slider">
               <div class="section-heading">
                  <a href="#" title="Phim Hot">
                  <span class="h-text">Phim Hot</span>
                  </a>
                  <ul class="heading-nav pull-right hidden-xs">
                     <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Phim Hot"></span></li>
                  </ul>
               </div>
               <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                  @foreach($phimhot as $key => $phim)
                  <article class="thumb grid-item post-38498">
                     <div class="halim-item">
                        <a class="halim-thumb" href="{{ route('movie',$phim->slug) }}" title="{{ $phim->title }}">
                           <figure><img class="lazy img-responsive" src="{{ asset('upload/movie/'.$phim->image) }}" alt="{{ $phim->title }}" title="{{ $phim->title }}"></figure>
                           <span class="status">
                              @if($phim->resolution==0)
                              HD
                              @elseif($phim->resolution==1)
                              SD
                              @elseif($phim->resolution==2)
                              HDCam
                              @elseif($phim->resolution==3)
                              FullHD
                              @endif
                           </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                              {{ $phim->episode_count }}/{{ $phim->sotap }}
                              @if($phim->phude==0)
                              Vietsub
                              @else
                              Thuyết minh
                              @endif
                              @if($phim->session != 0)
                              - session {{ $phim->session }}
                              @endif
                           </span> 
                           <div class="icon_overlay"></div>
                           <div class="halim-post-title-box">
                              <div class="halim-post-title ">
                                 <p class="entry-title">{{ $phim->title }}</p>
                                 <p class="original_title">{{ $phim->name_eng }}</p>
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
                  owl.owlCarousel(
                     {
                        loop: true,
                        margin: 5, // số lượng item có thể hiển thị cùng 1 lúc
                        autoplay: true,// để là true thì sau tầm 4s sẽ tự chuyển slide
                        autoplayTimeout: 4000,// 4000 là 4s
                        autoplayHoverPause: true,// khi hover vào thì sẽ dừng autoplay
                        nav: true,
                        navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>'],
                        responsiveClass: true,// tương thích, phì hợp với các màn hình
                        responsive: {0: {items:2},480: {items:3}, 600: {items:6},1000: {items: 6}}})});
               </script>
               {{-- <i class="hl-down-open rotate-right"></i> --}}
           </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               @foreach($category_home as $key => $cate_home)
               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                     <a href="danhmuc.php" title="Phim Bộ">
                     <span class="h-text">{{ $cate_home->title }}</span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                     
                     @foreach($cate_home->movie->take(12) as $key_movie => $mov)
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{ route('movie',$mov->slug) }}" title="{{ $mov->title }}">
                              <figure><img class="lazy img-responsive" src="{{ asset('upload/movie/'.$mov->image) }}" alt="{{ $mov->title }}" title="{{ $mov->title }}"></figure>
                              <span class="status">
                                 @if($mov->resolution==0)
                                 HD
                                 @elseif($mov->resolution==1)
                                 SD
                                 @elseif($mov->resolution==2)
                                 HDCam
                                 @elseif($mov->resolution==3)
                                 FullHD
                                 @endif   
                              </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                 {{ $mov->episode_count }}/{{ $mov->sotap }}
                                 @if($mov->phude==0)
                                 Vietsub
                                 @else
                                 Thuyết minh
                                 @endif
                                 @if($mov->session != 0)
                                 - session {{ $mov->session }}
                                 @endif
                              </span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{ $mov->title }}</p>
                                    <p class="original_title">{{ $mov->name_eng }}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>   
                     @endforeach
                  </div>
               </section>
               
               <div class="clearfix"></div>
               @endforeach
            </main>
            {{-- sidebar --}}
            @include('pages.include.sidebar')
</div>
@endsection