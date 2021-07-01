<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\Post\PostInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    private $postRepo;

    public function __construct(PostInterface $post)
    {
        $this->postRepo = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function home()
    {
        $posts = $this->postRepo->getActivePosts();
        return view('dashboard.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param $topic
     * @return Factory|View
     */
    public function topic($topic)
    {
        $posts = $this->postRepo->getTopicPosts($topic);
        $title = 'topic';
        return view('dashboard.index', compact('posts', 'title'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $posts = auth('admin')->check() ? $this->postRepo->getAllPosts() : $this->postRepo->getMyPosts();
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $next_id = DB::select("SHOW TABLE STATUS LIKE 'posts'")[0]->Auto_increment;
        $dir = "uploads/posts/$next_id";
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $thumbnail = $dir . '/thumbnail.' . $request->file('thumbnail')->getClientOriginalExtension();
        Image::make($request->file('thumbnail'))->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnail);

        $cover = $dir . '/cover.' . $request->file('cover')->getClientOriginalExtension();
        Image::make($request->file('cover'))->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($cover);

        if ($this->postRepo->create($request->all(), url($thumbnail), url($cover))) {
            return redirect()->back()->with('success', 'Post Created Successfully');
        }
        return  redirect()->back()->with('danger', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Factory|View
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $post = Post::withTrashed()->find($id);
        return view('dashboard.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::withTrashed()->find($id);
        $dir = "uploads/posts/$id";
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $thumbnail = $post['thumbnail'];
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $dir . '/thumbnail.' . $request->file('thumbnail')->getClientOriginalExtension();
            Image::make($request->file('thumbnail'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbnail);
            $thumbnail = url($thumbnail);
        }

        $cover = $post['cover'];
        if ($request->hasFile('cover')) {
            $cover = $dir . '/cover.' . $request->file('cover')->getClientOriginalExtension();
            Image::make($request->file('cover'))->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($cover);
            $cover = url($thumbnail);
        }

        if ($this->postRepo->update($post, $request->all(), $thumbnail, $cover)) {
            return redirect()->back()->with('success', 'Post Updated Successfully');
        }
        return  redirect()->back()->with('danger', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post)
    {
        if ($this->postRepo->delete($post)) {
            return redirect()->back()->with('success', 'Post Deleted Successfully');
        }
        return  redirect()->back()->with('danger', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($this->postRepo->forceDelete($post)) {
            if (\File::exists("uploads/posts/$id"))
                \File::deleteDirectory("uploads/posts/$id");
            return redirect()->back()->with('success', 'Post Deleted Successfully');
        }
        return  redirect()->back()->with('danger', 'Something went wrong');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($this->postRepo->restore($post)) {
            return redirect()->back()->with('success', 'Post Restored Successfully');
        }
        return  redirect()->back()->with('danger', 'Something went wrong');
    }
}
