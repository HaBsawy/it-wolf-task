<?php


namespace App\Repositories\Post;


use App\Models\Post;

class PostEloquent implements PostInterface
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function create(array $data, $thumbnail, $cover)
    {
        return auth('blogger')->user()->posts()->create([
            'title'     => $data['title'],
            'topic'     => $data['topic'],
            'content'   => $data['content'],
            'thumbnail' => $thumbnail,
            'cover'     => $cover,
        ]);
    }

    public function getAllPosts()
    {
        return $this->post->withTrashed()->paginate();
    }

    public function getActivePosts()
    {
        return $this->post->paginate();
    }

    public function getTopicPosts($topic)
    {
        return $this->post->where('topic', $topic)->paginate();
    }

    public function getMyPosts()
    {
        return auth('blogger')->user()->posts()->withTrashed()->paginate();
    }

    public function update(Post $post, array $data, $thumbnail, $cover)
    {
        return $post->update([
            'title'     => $data['title'],
            'topic'     => $data['topic'],
            'content'   => $data['content'],
            'thumbnail' => $thumbnail,
            'cover'     => $cover,
        ]);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }

    public function restore(Post $post)
    {
        return $post->restore();
    }

    public function forceDelete(Post $post)
    {
        return $post->forceDelete();
    }
}
