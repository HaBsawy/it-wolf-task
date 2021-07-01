<?php


namespace App\Repositories\Blogger;


use App\Models\Blogger;

class BloggerEloquent implements  BloggerInterface
{
    private $blogger;

    public function __construct(Blogger $blogger)
    {
        $this->blogger = $blogger;
    }

    public function create(array $data)
    {
        return $this->blogger->create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);
    }

    public function getBloggerPosts(Blogger $blogger)
    {
        return $blogger->posts()->paginate();
    }
}
