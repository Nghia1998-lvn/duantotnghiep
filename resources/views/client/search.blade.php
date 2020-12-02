@extends('layouts.app')
@section('title', 'Du lịch')

@section('content')
<section class="bg-accent border-bottom add-top-margin">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="topic-box topic-box-margin">Tin tức hot nhất</div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-6">
                <div class="feeding-text-dark">
                    <ol id="sample" class="ticker">
                        
                        <li>
                            <a href="{{url('/posts')}}">title</a>
                        </li>
                      
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Feed Area End Here -->
<!-- News Info List Area Start Here -->
<section class="bg-body">
    <div class="container">
        <ul class="news-info-list text-center--md">
            <li>
                <i class="fa fa-map-marker" aria-hidden="true"></i>Vietnamese
            </li>
            <li>
                <i class="fa fa-calendar" aria-hidden="true"></i><span id="current_date"></span>
            </li>
            <li>
                <i class="fa fa-clock-o" aria-hidden="true"></i><span id="current_time"></span>
            </li>
            <li>
                <i class="fa fa-cloud" aria-hidden="true"></i>29&#8451; Hoa Khanh, Da Nang
            </li>
        </ul>
    </div>
</section>
<!-- News Info List Area End Here -->
<!-- Breadcrumb Area Start Here -->
<section class="breadcrumbs-area" style="background-image: url('img/banner/breadcrumbs-banner.jpg');">
    <div class="container">
        <div class="breadcrumbs-content">
            <h1>Kết quả tìm kiếm từ khóa {{$key}}</h1>

        </div>
    </div>
</section>
<!-- Breadcrumb Area End Here -->
<!-- Post Style 1 Page Area Start Here -->
<section class="bg-body section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    @if($ketquatimkiem->count() == 0 )
                    {{"Không có kết quả nào"}}
                    @else 
                    @foreach ($ketquatimkiem as $ketqua)
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="{{url('/posts')}}/{{$ketqua->id}}/{{$ketqua->slug}}"
                                    class="img-opacity-hover img-overlay-70">
                                    <img src="{{url('/')}}{{$ketqua->image}}" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">{{$ketqua->category->category}}</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>Bởi</span>
                                            <a
                                                href="{{url('/auth-posts')}}/{{$ketqua->user->id}}/{{$ketqua->user->username}}">{{$ketqua->user->username}}</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>{{$ketqua->created_at}}
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="{{url('/posts')}}/{{$ketqua->id}}/{{$ketqua->slug}}">{{$ketqua->title}}</a>
                                </h3>
                                <p>{{$ketqua->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Mạng xã hội</div>
                    </div>
                    <ul class="stay-connected overflow-hidden">
                        <li class="facebook">
                            <a href="#">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                <div class="connection-quantity">50.2 k</div>
                                <p>Fans</p>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="#">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                                <div class="connection-quantity">10.3 k</div>
                                <p>Followers</p>
                            </a>
                        </li>
                        <li class="linkedin">
                            <a href="#">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                                <div class="connection-quantity">25.4 k</div>
                                <p>Fans</p>
                            </a>
                        </li>
                        <li class="rss">
                            <a href="#">
                                <i class="fa fa-rss" aria-hidden="true"></i>
                                <div class="connection-quantity">20.8 k</div>
                                <p>Subscriber</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-box">
                    <div class="ne-banner-layout1 text-center">
                        <a href="#">
                            <img src="{{url('clients')}}/img/banner/banner3.jpg" alt="ad" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Tin tức mới</div>
                    </div>
                    <div class="newsletter-area bg-primary">

                        <img src="{{url('clients')}}/img/banner/newsletter.png" alt="newsletter"
                            class="img-fluid m-auto mb-15">
                        <p>Đăng ký để nhận được thông báo sớm nhất </p>
                        <div class="input-group stylish-input-group">
                            <input type="text" placeholder="Nhập email của bạn" class="form-control">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection