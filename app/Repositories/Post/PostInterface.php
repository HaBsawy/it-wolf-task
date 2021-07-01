<?php


namespace App\Repositories\Post;


use App\Models\Post;

interface PostInterface
{
    public function create(array $data, $thumbnail, $cover);
    public function getAllPosts();
    public function getActivePosts();
    public function getTopicPosts($topic);
    public function getMyPosts();
    public function update(Post $post, array $data, $thumbnail, $cover);
    public function delete(Post $post);
    public function restore(Post $post);
    public function forceDelete(Post $post);
}
