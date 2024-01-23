<!DOCTYPE html>
<html lang="vi">
   <head>
      {{-- trang layout này là cho index user --}}
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      

      <link rel="shortcut icon" href="https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png" type="image/x-icon" />
      <meta name="revisit-after" content="1 days" />
      <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
      <title>Phim hay 2023 - Xem phim hay nhất</title>
      <meta name="description" content="Phim hay 2024 - Xem phim hay nhất, xem phim online miễn phí, phim hot , phim nhanh" />
      <link rel="canonical" href="">
      <link rel="next" href="" />
      <meta property="og:locale" content="vi_VN" />
      <meta property="og:title" content="Phim hay 2020 - Xem phim hay nhất" />
      <meta property="og:description" content="Phim hay 2024 - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp" />
      <meta property="og:url" content="" />
      <meta property="og:site_name" content="Phim hay 2024- Xem phim hay nhất" />
      <meta property="og:image" content="" />
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="55" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      
      <link rel='dns-prefetch' href='//s.w.org' />
      
      <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/bootstrap.min.css?ver=5.7.2') }}' media='all' />
      {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    
      <link rel='stylesheet' id='style-css' href='{{ asset('css/style.css?ver=5.7.2') }}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href='{{ asset('css/style.min.css?ver=5.7.2') }}' media='all' />
      <script type='text/javascript' src='{{ asset('js/jquery.min.js?ver=5.7.2') }}' id='halim-jquery-js'></script>
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
         }
      </style>
      <style>#header .site-title {background: url(https://phimyeuthichz.com/imgs/logo.svg) no-repeat top left;background-size: contain;text-indent: -9999px;}</style>
   </head>
   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" id="headwrap">
               <div class="col-md-3 col-sm-6 slogan">
                  <p class="site-title"><a class="logo" href="" title="phim hay ">Phim Hay</p>
                  </a>
               </div>
               <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                        <style type="text/css">
                           ul#result{
                              position: absolute;
                              z-index: 9999;
                              background: #1b2d3c;
                              width: 94%;
                              padding:10px;
                              margin:1px
                           }
                        </style>
                        <form id="search-form-pc" name="halimForm" role="search" action="{{ route('tim-kiem') }}" method="GET">
                           <div class="form-group form-timkiem">
                              <div class="input-group col-xs-12">
                                 <input type="text" name="search" id="timkiem" value="{{ isset($search) ? $search : ''}}" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" required>
                                 <i class="animate-spin hl-spin4 hidden"></i>
                                 {{-- <button class="btn btn-primary">Tìm kiếm</button> --}}
                              </div>
                              
                           </div>
                           <ul class="list-group ui-autocomplete ajax-results" id="result" style="display:none" ></ul>
                        </form>
                        {{-- <ul class="ui-autocomplete ajax-results hidden"></ul> --}}
                     </div>
                     
                  </div>
               </div>
               <style>
                  #get-bookmark-custom{
                     background: #224361;
                     display: inline-block;
                     line-height: 20px;
                     padding: 6px 15px;
                     border-radius: 20px;
                     color: #fff;
                     cursor: pointer;
                     transition: .4s all;
                     margin-top: 1px;
                     margin-right: 15px;
                  }
               </style>
               <div class="col-md-4 hidden-xs">
                  <div id="get-bookmark-custom" class="box-shadow">
                     
                        {{-- @if(session()->get('user_name')!=null)
                        <span>
                           <a href="{{ route('log_out') }}">Đăng xuất</a>
                        </span>
                        <a href="{{ url('phim-yeu-thich') }}"><i class="fa-regular fa-bookmark"></i></a>
                        {{-- phim đã lưu --}}
                        {{-- <span class="count">0</span> --}}
                        {{-- @else --}}
                        {{-- <span> --}}
                           {{-- <a href="{{ route('login') }}">Đăng Nhập</a> --}}
                        {{-- </span> --}}
                        {{-- @endif --}}
                        
                        {{-- <i class="fa-regular fa-user"></i> --}}
                        <div class="mega dropdown">
                        <a title="User" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"><i class="fa-regular fa-user"></i> <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu " style="width:200px;">
                              @if(session()->get('user_name')==null)
                              <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                              @endif
                              @if(session()->get('user_name')!=null)
                              <li><a href="{{ route('doi-mat-khau') }}">Đổi mật khẩu</a></li>
                              @endif
                              <li><a href="{{ url('phim-yeu-thich') }}">Phim yêu thích</a></li>
                              @if(session()->get('user_name')!=null)
                              <li><a href="{{ route('log_out') }}">Đăng xuất</a></li>
                              @endif
                              @if(session()->get('user_name')==null)
                              <li><a href="{{ route('dang-ky') }}">Đăng ký</a></li>
                              @endif
                           </ul>
                        </div>
                     
                  </div>
                  
                  {{-- <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                     <ul style="margin: 0;"></ul>
                  </div> --}}
               </div>
            </div>
         </div>
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  {{-- <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button> --}}
                  <div class="mega dropdown  navbar-toggle collapsed pull-right" >
                     <a title="User" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"><i class="fa-regular fa-user"></i> <span class="caret"></span></a>
                        <ul role="menu" class=" dropdown-menu " style="width:200px;">
                           @if(session()->get('user_name')==null)
                           <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                           @endif
                           @if(session()->get('user_name')!=null)
                           <li><a href="{{ route('doi-mat-khau') }}">Đổi mật khẩu</a></li>
                           @endif
                           <li><a href="{{ url('phim-yeu-thich') }}">Phim yêu thích</a></li>
                           @if(session()->get('user_name')!=null)
                           <li><a href="{{ route('log_out') }}">Đăng xuất</a></li>
                           @endif
                           @if(session()->get('user_name')==null)
                           <li><a href="{{ route('dang-ky') }}">Đăng ký</a></li>
                           @endif
                        </ul>
                     </div>
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item active"><a title="Trang Chủ" href="{{ route('homepage') }}">Trang Chủ</a></li>
                        @foreach($category as $key => $cate)
                           <li class="mega"><a title="{{ $cate->title }}" href="{{ route('category',$cate->slug) }}">{{ $cate->title }}</a></li>
                        @endforeach
                        

                        <li class="mega dropdown">
                           <a title="Năm" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @for($year = $year_now ; $year >= 2000;$year--)
                              <li><a title="Phim {{ $year }}" href="{{ route('year-movie',$year) }}">Phim {{ $year }}</a></li>
                              @endfor
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($genre as $key => $gen)
                              <li><a title="{{ $gen->title }}" href="{{ route('genre',$gen->slug) }}">{{ $gen->title }}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($country as $key => $country1)
                              <li><a title="{{ $country1->title }}" href="{{ route('country',$country1->slug) }}">{{ $country1->title }}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        {{-- <li><a title="Phim Lẻ" href="danhmuc.php">Phim Lẻ</a></li>
                        <li><a title="Phim Bộ" href="danhmuc.php">Phim Bộ</a></li>
                        <li><a title="Phim Chiếu Rạp" href="danhmuc.php">Phim Chiếu Rạp</a></li> --}}
                     </ul>
                  </div>
                  {{-- <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul> --}}
               </div>
            </nav>
            
         </div>
      </div>
      </div>
      
      <div class="container">
         <div class="row fullwith-slider"></div>
      </div>
      <div class="container">
         @yield('content')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container">
            <div class="footer__info">
               <div class="info__item introduce">
                  <p>
                     <img src="https://phimyeuthichz.com/imgs/logo.svg" alt="logo-footer" />
                  </p>
                  <p>
                     Website xem phim trực tuyến tốc độ cao dành cho cộng đồng yêu phim với những bộ phim hay đang được trình chiếu mới nhất.
                  </p>
                  <p>
                     tham gia và thảo luận những bộ phim hay mà mình yêu thích cùng Phimyeuthich.com nhé.
                  </p>   
               </div>
               <div class="info__item">
                  <div class="info__rule">
                     <div class="rule__item">
                        <p style="margin-bottom:20px">
                     
                        <a data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                        Giới thiệu
                        </a>
                        </p>
                        <p style="margin-bottom:20px">
                     
                        <a data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                        Liên hệ
                        </a>
                        </p>
                     </div>
                     <div class="rule__item">
                        <p style="margin-bottom:20px">
                     
                        <a data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                        Thỏa thuận sử dụng
                        </a>
                        </p>
                        <p style="margin-bottom:20px">
                     
                        <a data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                        Chính sách riêng tư
                        </a>
                        </p>
                     </div>
                  </div>
               </div>
               <div class="info__item info__contact">
                  <div class=" contact__img">
                     <div style="margin-bottom: 15px">
                        <a href="https://www.facebook.com/TeamPYT/" target="_blank">
                        <img src="https://phimyeuthichz.com/imgs/facebook-logo.png" alt />
                        Facebook
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer__copyright">
               <div class="copyright__content">
                  <p>
                     © 2023 PHIMYEUTHICH.COM (Chia sẻ phim online miễn phí)
                  </p>
                  <p>
                     Make by PHIMYEUTHICH TEAM
                  </p>
               </div>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>
     
      <script type='text/javascript' src='{{ asset('js/bootstrap.min.js?ver=5.7.2') }}' id='bootstrap-js'></script>
      <script type='text/javascript' src='{{ asset('js/owl.carousel.min.js?ver=5.7.2') }}' id='carousel-js'></script>
     {{-- script phan binh luan --}}
     <div id="fb-root"></div>
     <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="DOroTHKA"></script>
     {{-- script phan binh luan --}}

      <script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js?ver=1626273138') }}' id='halim-init-js'></script>
      {{-- ajax phan search phim --}}
      <script type="text/javascript">
         $(document).ready(function(){
            $('#timkiem').keyup(function(){
               $('#result').html('');
               var search = $('#timkiem').val();
               // alert(search);
               if(search!=''){
                  var expression = new RegExp(search,"i");
                  // alert(expression);
                  $.getJSON('/json/movie.json',function(data){
                     $.each(data,function(key,value){
                        if(value.title.search(expression) != -1 || value.description.search(expression) != -1){
                           $('#result').css('display','inherit');
                           $('#result').append('<li style="cursor:pointer; display: flex; max-height: 200px;" class="list-group-item link-class"><img src="/upload/movie/'+value.image+'" width="100" class="" /><div style="flex-direction: column; margin-left: 2px;"><h4 width="100%"><a href="/phim/'+value.slug+'">'+value.title+'</a></h4><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted">| '+value.description+'</span></div></li>');
                        }
                     });
                  });
               }
               else{
                  $('#result').css('display','none');
               }
            })

            $('#result').on('click','li' , function(){
               var click_text = $(this).text().split('|');
               $('#timkiem').val($.trim(click_text[0]));
               $("#result").html('');
               $('#result').css('display','none');
               
            });
         })
      </script>
      {{-- phần ajax ngày tuần tháng của top view --}}
      {{-- khi load trang , phần default này sẽ chạy --}}
      <script type='text/javascript'>
         $(document).ready(function(){
            $.ajax({
               url:"{{ url('/filter-topview-default') }}",
               method:"GET",
               success:function(data)
               {
                  $('#show_data_default').html(data);
               }
            });
         
         
         $('.filter-sidebar').click(function(){
            var href = $(this).attr('href');
            if(href == '#ngay')
            {
               var value = 0;
            }
            else if(href == '#tuan'){
               var value = 1;
            }
            else{
               var value = 2;
            }
            $.ajax({
               url:"{{ url('/filter-topview-phim') }}",
               method:"GET",
               data:{value:value},
               success:function(data)
                  {
                     $('#halim-ajax-popular-post-default').css("display","none")
                     $('#show_data').html(data);
                  }

            });
         })
      })
      </script>
   </body>
</html>