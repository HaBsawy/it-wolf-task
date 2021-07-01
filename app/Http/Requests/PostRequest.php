<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = $this->isMethod('POST') ? null : Post::withTrashed()->find($this->route('post'));
        return $this->isMethod('POST') ? auth('blogger')->check() :
            auth('admin')->check() || (auth('blogger')->check() && $post->blogger_id == auth('blogger')->id());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isMethod('POST') ? [
            'title'     => 'required|string|between:5,255',
            'topic'     => 'required|in:Science,Sport,Movies,Music,Literature',
            'thumbnail' => 'required|image',
            'cover'     => 'required|image',
            'content'   => 'required|string|between:5,2000',
        ] : [
            'title'     => 'required|string|between:5,255',
            'topic'     => 'required|in:Science,Sport,Movies,Music,Literature',
            'thumbnail' => 'sometimes|image',
            'cover'     => 'sometimes|image',
            'content'   => 'required|string|between:5,2000',
        ];
    }
}
