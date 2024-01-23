<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      
      <link rel='dns-prefetch' href='//s.w.org' />
      
      <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/bootstrap.min.css?ver=5.7.2') }}' media='all' />
      {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    
      <link rel='stylesheet' id='style-css' href='{{ asset('css/style.css?ver=5.7.2') }}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href='{{ asset('css/style.min.css?ver=5.7.2') }}' media='all' />
</head>
<body>
    <div class="container">
        <h1>Xin chào {{ $user_nhan }}</h1>
        <br>
        <h4>Chúng tôi gửi tới mật khẩu của bạn từ trang web phimhayxzy</h4>
        <br>
        <h4>Bạn vui lòng không cung cấp mật khẩu này cho bất kỳ ai</h4>
        <br>
        Mật khẩu của bạn là : <span style="color: red">{{ $noidung_nhan }}</span>
    </div>



</body>
</html>