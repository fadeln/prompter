<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prompt;
use App\Models\Comment;
class CommentController extends Controller
{
    public function store(Request $request, Prompt $prompt)
    {
        $data = $request->validate([
            'comment' => ['required', 'string'],
        ]);
        
        $data['user_id'] = $request->user()->id;
        $data['prompt_id'] = $prompt->id;

        $prompt = Comment::create($data);

        return to_route('prompt.index')->with('success', 'comment added');
    }

    public function destroy(Prompt $prompt, Comment $comment)
    {
        if ($comment->user_id != request()->user()->id) {
            abort(403);
        }

        $comment->delete();

        return to_route('prompt.index')->with('success', 'comment deleted');
    }

    public function like(Request $request, Comment $comment)
    {
        $user = request()->user();

        if (
            !$user
                ->likeComments()
                ->where('likeable_id', $comment->id)
                ->where('likeable_type', get_class($comment))
                ->exists()
        ) {
            $user->likeComments()->attach($comment->id);
        }

        return back()->with('success', 'liked success!');
    }

    public function unLike(Request $request, Comment $comment)
    {
        $user = request()->user();

        if (
            $user
                ->likeComments()
                ->where('likeable_id', $comment->id)
                ->where('likeable_type', get_class($comment))
                ->exists()
        ) {
            $user->likeComments()->detach($comment->id);
        }

        return back()->with('success', 'liked success!');
    }
}
