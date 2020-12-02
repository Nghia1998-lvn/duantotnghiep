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
                    <form id="form" action="{{asset('/panel/create-category')}}" method="post"
                        enctype="multipart/form-data"> @csrf
                        <div class=" card card-primary card-outline">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên chuyên mục </label>
                                    <input type="text" class="form-control" placeholder="Tên chuyên mục" name="category">
                                    <code class="error-title">@error('title') {{ $message }}@enderror</code>
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
                                <button type="submit" class="btn btn-primary"> Thêm chuyên mục</button>
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