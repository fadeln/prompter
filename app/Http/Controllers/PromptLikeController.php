<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;

class PromptLikeController extends Controller
{
    public function store(Prompt $prompt)
    {
        $liker = request()->user();
        // Check if the user has already liked the prompt
        if (
            $liker
                ->likes()
                ->where('prompt_id', $prompt->id)
                ->exists()
        ) {
            // User has already liked the prompt, return with a message
            return redirect()->route('prompt.index')->with('error', 'You have already liked this prompt.');
        }

        $liker->likes()->attach($prompt);

        return to_route('prompt.index')->with('success', 'prompt liked');
    }
    public function destroy(Prompt $prompt)
    {
        $liker = request()->user();

        $liker->likes()->detach($prompt);

        return to_route('prompt.index')->with('success', 'prompt unliked');
    }
}
