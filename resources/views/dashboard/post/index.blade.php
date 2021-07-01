@extends('dashboard.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>View Bloggers</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Bloggers</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">View</a>
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
                                <h5>Blogger</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                </div>
                            </div>
                            <div class="card-block table-border-style p-25">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Topic</th>
                                            <th>Content</th>
                                            <th>Thumbnail</th>
                                            <th>Cover</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($posts as $key => $post)
                                                <tr class="{{ $post['deleted_at'] ? 'bg-danger' : '' }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $post->topic }}</td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ substr($post->content, 0, 50) }}...</td>
                                                    <td>
                                                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" width="100">
                                                    </td>
                                                    <td>
                                                        <img src="{{ $post->cover }}" alt="{{ $post->title }}" width="200">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('posts.edit', $post->id) }}" style="margin-right: 20px"><i class="icofont icofont-edit"></i></a>
                                                        @if(auth('blogger')->check())
                                                            @if($post['deleted_at'])
                                                                <a href="{{ route('posts.restore', $post->id) }}" class="restore" style="margin-right: 20px"><i class="icofont icofont-book-alt"></i></a>
                                                            @endif
                                                            <a href="{{ route($post['deleted_at'] ? 'posts.forceDelete' : 'posts.destroy', $post->id) }}" class="delete"><i class="icofont icofont-trash"></i></a>
                                                        @elseif(auth()->check())
                                                            <a href="{{ route('posts.forceDelete', $post->id) }}" class="delete"><i class="icofont icofont-trash"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7">There is no posts</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $posts->links('vendor.pagination.bootstrap-4') }}
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

<form method="POST" action="" id="delete-form">
    @csrf
    @method('DELETE')
</form>

<form method="POST" action="" id="restore-form">
    @csrf
</form>

@push('custom-scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.delete').click(function (e) {
            e.preventDefault();
            let link = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form').attr('action', link).submit();
                }
            })
        });

        $('.restore').click(function (e) {
            e.preventDefault();
            let link = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#restore-form').attr('action', link).submit();
                }
            })
        })
    </script>
@endpush
