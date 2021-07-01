@extends('dashboard.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Create New Post</h4>
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
                        <li class="breadcrumb-item"><a href="#!">Create</a>
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
                                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" placeholder="Type your title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Topic</label>
                                        <div class="col-sm-10">
                                            <select name="topic" class="form-control">
                                                <option value="">Select One topic Only</option>
                                                <option value="Science">Science</option>
                                                <option value="Sports">Sports</option>
                                                <option value="Movies">Movies</option>
                                                <option value="Music">Music</option>
                                                <option value="Literature">Literature</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Thumbnail</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="thumbnail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Cover</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="cover" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Content</label>
                                        <div class="col-sm-10">
                                            <textarea rows="5" cols="5" class="form-control" name="content" placeholder="Type your content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <button class="btn btn-success">Create</button>
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
