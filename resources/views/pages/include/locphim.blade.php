<form action="{{ route('loc-phim') }}"  method="GET" class="form-filter">
    {{-- @csrf --}}
    <style type="text/css">
      .stylish_filter{
          border:0;
          background: #12171b;
          color: #fff;
      }
      .btn-filter{
          border:0 #b2b7bb;
          background: #12171b;
          color: #fff;
          padding: 9px;
      }
    </style>
    <div class="col-md-2">
       <div class="form-group ">
          
          <select class="form-control stylish_filter" name="order" id="">
             <option value="0" {{ isset($sapxep) && $sapxep == 0 ? 'selected' : '' }}>-Sắp xếp-</option>
             <option value="1" {{ isset($sapxep) && $sapxep == 1 ? 'selected' : '' }}>-Ngày Đăng-</option>
             <option value="2" {{ isset($sapxep) && $sapxep == 2 ? 'selected' : '' }}>-Năm Sản Xuất-</option>
             <option value="3" {{ isset($sapxep) && $sapxep == 3 ? 'selected' : '' }}>-Tên Phim-</option>

          </select>
       </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
          
          <select class="form-control stylish_filter" name="category" id="">
                <option value="0">-danh mục-</option>
             @foreach($category as $key => $cate_filter)
                <option value="{{ $cate_filter->id }}" {{ isset($category_id) && $category_id == $cate_filter->id ? 'selected' : '' }}>{{ $cate_filter->title }}</option>
             @endforeach
          </select>
       </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
          
          <select class="form-control stylish_filter" name="genre" id="">
             <option value="0">-Thể loại-</option>
             @foreach($genre as $key => $gen_filter)
             <option value="{{ $gen_filter->id }}" {{ isset($genre_id) && $genre_id == $gen_filter->id ? 'selected' : '' }}>{{ $gen_filter->title }}</option>
             @endforeach
          </select>
       </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
          
          <select class="form-control stylish_filter" name="country" id="">
             <option value="0">-Quốc gia-</option>
             @foreach($country as $key => $country_filter)
             <option value="{{ $country_filter->id }}" {{ isset($country_id) && $country_id == $country_filter->id ? 'selected' : '' }}>{{ $country_filter->title }}</option>
             @endforeach
          </select>
       </div>
    </div>
    <div class="col-md-2">
       <div class="form-group">
          
          <select class="form-control stylish_filter" name="year" id="">
             <option value="0">-Năm-</option>
             @for($year1 = $year_now ; $year1 >= 2000;$year1--)
             <option value="{{ $year1 }}" {{ isset($year) && $year == $year1 ? 'selected' : '' }}>{{ $year1 }}</option>
             @endfor
          </select>
       </div>
    </div>
    <div class="col-md-2">
       <input type="submit" class="btn btn-sm btn-default btn-filter" value="Lọc Phim">
    </div>
    
 </form>