@extends('dashboard.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Edit Post</h4>
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
                        <li class="breadcrumb-item"><a href="#!">Edit</a>
                        </li>
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
                                <h5>Post</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                </div>
                            </div>
                            <div class="card-block">
                                <form method="POST" action="{{ route('posts.update', $post['id']) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" placeholder="Type your title" value="{{ $post['title'] }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Topic</label>
                                        <div class="col-sm-10">
                                            <select name="topic" class="form-control">
                                                <option {{ $post['topic'] == 'Science' ? 'selected' : '' }} value="Science">Science</option>
                                                <option {{ $post['topic'] == 'Sports' ? 'selected' : '' }} value="Sports">Sports</option>
                                                <option {{ $post['topic'] == 'Movies' ? 'selected' : '' }} value="Movies">Movies</option>
                                                <option {{ $post['topic'] == 'Music' ? 'selected' : '' }} value="Music">Music</option>
                                                <option {{ $post['topic'] == 'Literature' ? 'selected' : '' }} value="Literature">Literature</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Content</label>
                                        <div class="col-sm-10">
                                            <textarea rows="5" cols="5" class="form-control" name="content" placeholder="Type your content">{{ $post['content'] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Thumbnail</label>
                                        <div class="col-sm-10">
                                            <img src="{{ $post['thumbnail'] }}" alt="{{ $post['title'] }}" width="100">
                                            <input type="file" name="thumbnail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Cover</label>
                                        <div class="col-sm-10">
                                            <img src="{{ $post['cover'] }}" alt="{{ $post['title'] }}" width="200">
                                            <input type="file" name="cover" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </form>
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
