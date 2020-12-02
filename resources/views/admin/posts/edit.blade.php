@extends('layouts.master')
@section('title', 'Tạo bài viết mới')
@section('scriptTop')
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tạo bài viết mới</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/panel')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Tạo bài viết mới</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="form" action="{{url('/panel/post',$posts->id)}}" method="post"
                        enctype="multipart/form-data"> @csrf @method('PUT')
                        <div class=" card card-primary card-outline">
                            <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa bài viết: {{$posts->title}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-control custom-select" name="category_id">
                                    
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $posts->category_id) {{"selected"}} @endif>{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                    <code class="error-category">
                                        @error('category_id') {{ $message }}@enderror
                                    </code>
                                </div>
                                <div class="form-group">
                                    <label for="">Tiêu đề </label>
                                    <input type="text" class="form-control" value="{{$posts->title}}" name="title">
                                    <code class="error-title">@error('title') {{ $message }}@enderror</code>
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả ngắn</label>
                                    <input class="form-control" value="{{$posts->description}}" name="description">
                                    <code class="error-description">@error('description') {{ $message }}@enderror</code>
                                </div>
                                <div class="form-group">
                                    <label for="">Ảnh hiển thị</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <img src="{{url('/')}}{{$posts->image}}" height="50px" width="50px"/>
                                    </div>
                                    <code class="error-image">@error('image') {{ $message }}@enderror</code>
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung chính </label>
                                    <textarea id="compose-textarea" class="form-control" style="height: 300px;"
                                        name="content">
                                        @php 
                                        echo $posts->content;
                                        @endphp
                                </textarea>
                                    <code class="error-content">@error('content') {{ $message }}@enderror</code>
                                </div>
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @elseif(session()->has('danger'))
                                <div class="alert alert-danger">
                                    {{ session()->get('danger') }}
                                </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"> Chỉnh sửa</button>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
@section('script')
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
        height: 150
    });
  })
</script>
<script src="{{asset('admin/main/create-post.js')}}"></script>
@endsection