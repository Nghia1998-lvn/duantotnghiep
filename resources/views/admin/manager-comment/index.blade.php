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
                        <h1>Quản lý bình luận</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/panel')}}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Quản lý bình luận</li>
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
                            <th scope="col">Người bình luận</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col" colspan="2">Chức năng</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                          <tr>
                          <th scope="row">{{$comment->id}}</th>
                            <td>{{$comment->user_id}}</td>
                            <td>{{$comment->news_id}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>
                                <form action="{{url('panel/comment',$comment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button></td>
                                </form>
                            </td>
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