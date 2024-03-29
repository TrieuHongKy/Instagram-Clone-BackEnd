<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\FileService;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = new Post();
        $request->validate([
            'file' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:2048',
            'text' => 'required'
        ]);
        $post = (new FileService)->updateFile($post, $request, 'post');

        $post->user_id = auth()->user()->id;
        $post->text = $request->input('text');
        $post->save();
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!empty($post->file)){
            $currentFile = public_path() . $post->file;

            if (file_exists($currentFile)){
                unlink($currentFile);
            }
        }

        $post->delete();
    }
}
