<?php


namespace App\Repositories\Blogger;


use App\Models\Blogger;

interface BloggerInterface
{
    public function create(array $data);
    public function getBloggerPosts(Blogger $blogger);
}
