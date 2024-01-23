@extends('layouts.app')

@section('content')
<div class="col-md-12">
<table class="table" id="tablephim">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">Ngày tạo</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($list as $key => $user)
        <tr>
            <td>{{ $key }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->create_at }}</td>
            <td>
                <div style="display: flex;">
                    <form action="{{ route('user.destroy',$user->id) }}" method="POST" onclick="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Xóa" class="btn btn-danger">
                    </form>
                    {{-- <a href="{{ route('genre.edit',$cate->id) }}" class="btn btn-warning" style="margin-left: 5px">Sửa</a> --}}
                
                </div>
            </td>
        </tr>

        @endforeach
      
      
    </tbody>
</table>
</div>
@endsection