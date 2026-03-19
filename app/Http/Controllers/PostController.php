<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller {
    public function index() {
        $posts = DB::table('posts')->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id) {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function create() {
        return view('posts/create');
    }

    public function store(Request $request) {

        $request->validate([
            'post_name' => 'required|max:20',
            'content' => 'required|max:200',
        ]);

        DB::table('posts')->insert([
        'title' => $request->input('post_name'),
        'content' => $request->input('content'),
        ]);

        return redirect('/posts');

    }
}