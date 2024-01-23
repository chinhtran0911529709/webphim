@extends('layouts.app')

@section('content')

                <div class="card-header">Quản lý danh mục</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{ route(isset($category) ? 'category.update' : 'category.store' , isset($category) ? $category->id : '') }}" method="POST">
                            @csrf
                            @if(isset($category))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="slug" required onkeyup="ChangeToSlug()" value="{{ isset($category) ? $category->title : '' }}" class="form-control" placeholder="Nhập vào dữ liệu ...">
                                
                            </div>
                            <div class="form-group">
                                <label for="slug">slug</label>
                                <input type="text" name="slug" required id="convert_slug" value="{{ isset($category) ? $category->slug : '' }}" class="form-control" placeholder="Nhập vào dữ liệu slug ...">
                                
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" required id="description" cols="30" rows="10" class="form-control" style="resize: none;">{{ isset($category) ? $category->description: '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">status</label>
                                
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>hiển thị</option>
                                    <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>không hiển thị</option>
                                </select>
                            </div>
                            <input type="submit" value="{{ isset($category) ? 'Sửa thông tin' : 'thêm mới' }}" class="btn btn-success">
                        </form>

@endsection
