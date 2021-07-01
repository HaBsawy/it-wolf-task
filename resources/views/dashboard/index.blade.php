@extends('dashboard.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>{{ $title ?? 'Home' }}</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        @if(isset($title) && $title == 'topic')
                        <li class="breadcrumb-item"><a href="#!">Topic</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">{{ request()->route('topic') }}</a>
                        </li>
                        @elseif(isset($title) && $title == 'blogger')
                            <li class="breadcrumb-item"><a href="#!">Blogger</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">{{ request()->route('blogger')['name'] }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Page header end -->
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Posts</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="card blog-page" id="blog">
                                    <div class="card-block">
                                        <div class="row">
                                            @forelse($posts as $post)
                                                <div class="col-md-6 col-xl-4 blog-page-card m-b-20">
                                                <div class="blog-box">
                                                    <div class="blog-img">
                                                        <img class="img-fluid" src="{{ $post['cover'] }}" alt="{{ $post['title'] }}">
                                                        <div class="sharing">
                                                            <img class="img-fluid" src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}" style="width: 100px; border: 3px solid #fff">
                                                        </div>
                                                    </div>
                                                    <div class="blog-detail">
                                                        <div class="blog-title">
                                                            <h5>{{ $post['title'] }}</h5>
                                                        </div>
                                                        <div class="blog-date">
                                                            <i class="icon-calendar icons"></i>
                                                            <i>{{ $post['created_at'] }}</i>
                                                            @unless(isset($title) && $title == 'blogger')
                                                            <p class="author"><b>Posted by :</b> <a href="{{ route('bloggers.show', $post['blogger_id']) }}">{{ $post['blogger']['name'] }}</a></p>
                                                            @endunless
                                                            @unless(isset($title) && $title == 'topic')
                                                            <p class="topic"><b>Topic :</b> <a href="{{ route('posts.topic', $post['topic']) }}">{{ $post['topic'] }}</a></p>
                                                            @endunless
                                                        </div>
                                                        <p>{{ substr($post['content'], 0, 100) }}...<a href="{{ route('posts.show', $post->id) }}">Read More</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                                <h2>There is no Posts</h2>
                                            @endforelse
                                            {{ $posts->links('vendor.pagination.bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                    </div>
                </div>
            </div>
            <!-- Page body end -->
        </div>
    </div>
@endsection
