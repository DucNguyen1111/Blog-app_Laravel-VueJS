<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create(Request $request)
    {
        try {
            Post::insert([
                "postid" => $request->postId,
                "userid" => $request->userId,
                "post_title" => $request->postTitle,
                "post_content" => $request->postContent,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response()->json([
                "message" => 'Post was created!'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'insert fail'
            ], 404);
        }
    }
    // get all of posts
    public function getAll(Request $request)
    {
        try {
            $posts = Post::join('users', 'users.userid', '=', 'posts.userid')->orderBy('posts.created_at', 'desc')->get()->makeHidden(['password']);
            return response()->json([
                "posts" => $posts
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'Request fail'
            ], 404);
        }
    }
    // edit post
    public function update(Request $request, $id)
    {
        try {
            Post::where('postid', $id)->update([
                "post_title" => $request->postTitle,
                "post_content" => $request->postContent,
                'updated_at' => Carbon::now(),
            ]);
            return response()->json([
                "message" => 'Post was updated',
                "status" => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'Update fail'
            ], 404);
        }
    }
    // delete post
    public function destroy(Request $request, $id)
    {
        $request->header('user_token');
        try {
            Post::where('postid', $id)->delete();
            return response()->json([
                "message" => 'Post was deleted',
                "status" => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'Delete fail'
            ], 404);
        }
    }
    // get comments
    public function getPost(Request $request, $id)
    {
        try {
            $post = Post::where('postid', $id)->get()[0];
            $user = $post->user()->get()->first();
            return response()->json([
                "post" => $post,
                "comments" => $post->comments()->join('users', 'users.userid', '=', 'comments.userid')->orderBy('comments.created_at', 'asc')->get()->makeHidden(['password']),
                "user" => [
                    "name" => $user->username,
                    "avt" => $user->avt
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Error to get comments",
                "status" => 404
            ]);
        }
    }
}
