<div>
    <a href="{{ route('prompt.create') }}">Post your prompt</a>
    @foreach ($prompts as $prompt)
        <div class="border-spacing-1 border-blue-300 border-solid">
            <p>{{ $prompt->prompt }}</p>
            @if ($prompt->image)
                <p>Image url: {{ $prompt->image->url }}</p>
            @endif
            <p>Author: {{ $prompt->user->name }}</p>
            <p>Likes: {{ $prompt->likes()->count() }}</p>
            <p>Category: {{ $prompt->category->title }}</p>
            @if ($prompt->tags->isNotEmpty())
                <p>Tags: @foreach ($prompt->tags as $tag) {{ $tag->name }} @endforeach</p>
            @endif
            <div>
                <a href="{{ route('prompt.show', $prompt) }}">Details</a>
                <a href="{{ route('prompt.edit', $prompt) }}">Edit</a>
                <form action="{{ route('prompt.destroy', $prompt) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
                @auth
                    <form action="{{ request()->user()->isLiked($prompt) ? route('prompt.unlike', $prompt) : route('prompt.like', $prompt) }}" method="POST">
                        @csrf
                        @method(request()->user()->isLiked($prompt) ? 'DELETE' : 'POST')
                        <button>{{ request()->user()->isLiked($prompt) ? 'Unlike' : 'Like' }}</button>
                    </form>
                @endauth
            </div>
        </div>
        <br>
    @endforeach
</div>
