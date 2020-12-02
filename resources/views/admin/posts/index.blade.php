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
                        <h1>Bài viết của tôi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/panel')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Bài viết của tôi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @elseif(session()->has('danger'))
            <div class="alert alert-danger">
                {{ session()->get('danger') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên bài viết</th>
                            <th scope="col">Người viết</th>
                            <th scope="col">Chuyên mục</th>
                            <th scope="col">Ngày viết</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Chức năng</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                          <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>
                                @foreach($post->getUser($post->user_id) as $user)
                                {{$user->username}}
                              @endforeach
                            </td>
                          <td>
                              @foreach($post->getCategory($post->category_id) as $category)
                                {{$category->category}}
                              @endforeach
                             
                            </td>
                            <td>{{$post->created_at}}</td>
                            <td>@if($post->status == 0)
                                <span class="badge badge-pill badge-success">Đang chờ duyệt</span>
                                @else
                                <span class="badge badge-pill badge-danger">Đã duyệt</span></td>
                                @endif
                                <td><a href="{{url("panel/post/".$post->id)}}" class="btn btn-primary">Sửa</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
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