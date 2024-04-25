<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Prompt;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Retrieve prompts filtered by search query
        $prompts = Prompt::where('prompt', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('prompt.index', ['prompts' => $prompts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('prompt.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'prompt' => ['required', 'string'],
            'category_id' => ['required'],
        ]);
        $data['user_id'] = request()->user()->id;

        $prompt = Prompt::create($data);

        $tags = preg_split('/[,# ]+/', $request->input('tags'));
        $tags = array_filter($tags);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName) && $tagName[0] !== '#') {
                $tagName = '#' . $tagName;
            }
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        if ($request->has('image_url')) {
            $imageUrl = $request->input('image_url');
            if ($imageUrl) {
                $prompt->image()->create(['url' => $imageUrl]);
            }
        }
        $prompt->tags()->sync($tagIds);

        return to_route('prompt.index')->with('success', 'prompt created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prompt $prompt)
    {
        return view('prompt.show', ['prompt' => $prompt]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prompt $prompt)
    {
        if ($prompt->user_id != request()->user()->id) {
            abort(403);
        }

        $categories = Category::all();
        return view('prompt.edit', ['prompt' => $prompt, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prompt $prompt)
    {
        if ($prompt->user_id != $request->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'prompt' => ['required', 'string'],
            'category_id' => ['required'],
        ]);

        $prompt->update($data);
        $tagIds = $this->syncTags($request->input('tags'));

        if ($request->has('image_url')) {
            $prompt->image()->update(['url' => $request->input('image_url')]);
        }

        $prompt->tags()->sync($tagIds);

        return redirect()->route('prompt.show', $prompt)->with('success', 'Prompt updated');
    }

    private function syncTags($tagsInput)
    {
        $tags = preg_split('/[,# ]+/', $tagsInput);
        $tags = array_filter($tags);
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName) && $tagName[0] !== '#') {
                $tagName = '#' . $tagName;
            }
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prompt $prompt)
    {
        if ($prompt->user_id != request()->user()->id) {
            abort(403);
        }

        $prompt->delete();

        return to_route('prompt.index')->with('success', 'prompt deleted');
    }

    /**
     * Gives a like to the prompt
     */
    public function like(Request $request, Prompt $prompt)
    {
        $user = request()->user();

        if (
            !$user
                ->likePrompts()
                ->where('likeable_id', $prompt->id)
                ->where('likeable_type', get_class($prompt))
                ->exists()
        ) {
            $user->likePrompts()->attach($prompt->id);
        }

        return back()->with('success', 'liked success!');
    }

    public function unLike(Request $request, Prompt $prompt)
    {
        $user = request()->user();

        if (
            $user
                ->likePrompts()
                ->where('likeable_id', $prompt->id)
                ->where('likeable_type', get_class($prompt))
                ->exists()
        ) {
            $user->likePrompts()->detach($prompt->id);
        }

        return back()->with('success', 'liked success!');
    }

    public function favorites()
    {
        $user = request()->user();
        $prompts = $user->favorites()->orderBy('created_at', 'desc')->paginate(10);
        return view('prompt.favorites', ['prompts' => $prompts]);
    }
}
