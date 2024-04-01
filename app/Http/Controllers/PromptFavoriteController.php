<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prompt;

class PromptFavoriteController extends Controller
{
    public function store(Prompt $prompt)
    {
        $user = request()->user();
        
        if (!$user->favorites()->where('prompt_id', $prompt->id)->exists()) {
            $user->favorites()->attach($prompt->id);
        }

        return back()->with("success","favorited success!");
    }

    public function destroy(Prompt $prompt)
    {
        $user = request()->user();
        if ($user->favorites()->where('prompt_id', $prompt->id)->exists()) {
            $user->favorites()->detach($prompt->id);
        }

        return back()->with("success","unfavorited success!");
    }
}
