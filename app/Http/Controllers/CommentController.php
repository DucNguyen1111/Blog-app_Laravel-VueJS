<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //create comment
    public function create(Request $request)
    {
        try {
            Comment::insert([
                "commentid" => $request->commentId,
                "userid" => $request->userId,
                "postid" => $request->postId,
                "commentContent" => $request->commentContent,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
            return response()->json([
                "message" => "Comment successfully!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Comment fail",
                "status" => 404
            ]);
        }
    }
    // update comment
    public function updateComment(Request $request, $id)
    {
        try {
            Comment::where('commentid', $id)->update([
                "commentContent" => $request->commentContent,
                'updated_at' => Carbon::now(),
            ]);
            return response()->json([
                "message" => "Comment successfully!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Edit fail",
                "status" => 404
            ]);
        }
    }

    // get comment following post
    public function getCommentOfPost(Request $request, $id)
    {
        try {
            $comments = Comment::where('postid', $id)->get();
            return response()->json([
                "comments" => $comments
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Geting comments fail",
                "status" => 404
            ]);
        }
    }
    // delete comment
    public function destroy(Request $request, $id)
    {
        try {
            Comment::where('commentid', $id)->delete();
            return response()->json([
                "message" => "Comment was deleted!"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Delete fail",
                "status" => 404
            ]);
        }
    }
}
