@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">slug</th>
        <th scope="col">decription</th>
        <th scope="col">Active/Inactive</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $cate)
        <tr>
            <th scope="row">{{ $key }}</th>
            <td>{{ $cate->title }}</td>
            <td>{{ $cate->slug }}</td>
            <td>{{$cate->description}}</td>
            <td>
                @if ($cate->status)
                    Hiển thị
                @else
                    Không hiển thị
                @endif
            </td>
            <td>
                {{-- <a href="{{ route('category.destroy',$cate->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</a> --}}
                {{-- <form id="delete-form-{{ $cate->id }}" action="{{ route('category.destroy', $cate->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form> --}}
                <div style="display: flex;">
                    <form action="{{ route('category.destroy',$cate->id) }}" method="POST" onclick="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Xóa" class="btn btn-danger">
                    </form>
                    <a href="{{ route('category.edit',$cate->id) }}" class="btn btn-warning" style="margin-left: 5px">Sửa</a>
                </td>
                </div>
                
          </tr>
        @endforeach
      
      
    </tbody>
</table>
</div>

@endsection