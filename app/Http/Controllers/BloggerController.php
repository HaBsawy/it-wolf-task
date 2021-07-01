<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloggerRequest;
use App\Models\Blogger;
use App\Repositories\Blogger\BloggerInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class BloggerController extends Controller
{
    private $bloggerRepo;

    public function __construct(BloggerInterface $blogger)
    {
        $this->bloggerRepo = $blogger;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.blogger.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.blogger.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BloggerRequest $request
     * @return RedirectResponse
     */
    public function store(BloggerRequest $request)
    {
        if ($this->bloggerRepo->create($request->all())) {
            return redirect()->back()->with('success', 'Blogger Created Successfully');
        }
        return  redirect()->back()->with('danger', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param Blogger $blogger
     * @return Factory|View
     */
    public function show(Blogger $blogger)
    {
        $posts = $this->bloggerRepo->getBloggerPosts($blogger);
        $title = 'blogger';
        return view('dashboard.index', compact('posts', 'title'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function data()
    {
        return Datatables::of(Blogger::all())->make(true);
    }
}
