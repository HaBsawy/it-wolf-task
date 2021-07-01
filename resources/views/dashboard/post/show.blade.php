@extends('dashboard.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Post detail</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Posts</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Detail</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Blog card start -->
                        <div class="card blog-page">
                            <div class="card-block">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="blog-single">
                                            <img src="{{ $post['cover'] }}" alt="image-blog" class="img-fluid w-100">
                                            <h4 class="m-b-0">{{ $post['title'] }}</h4>
                                            <p>{{ $post['content'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Blog card end -->
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
@endsection


