<div>
    <p>
        {{ $prompt->prompt }}
    </p>
    <div>
        <form action="{{ route('prompt.comment.store', $prompt) }}" method="post">
            @csrf
            <textarea name="comment" id="comment" cols="30" rows="10">

            </textarea>
            <button>
                add comment
            </button>
        </form>
    </div>
    <div>
        @foreach ($prompt->comments as $comment)
            <br>
            comment by : {{ $comment->user->name }}
            <p>
                {{ $comment->comment }}
            </p>
            <p>
                like: {{ $comment->likes()->count() }}
            </p>
            <form
                action="{{ request()->user()->isLikedComment($comment) ? route('comment.unlike', $comment) : route('comment.like', $comment) }}"
                method="POST">
                @csrf
                @method(request()->user()->isLikedComment($comment) ? 'DELETE' : 'POST')
                <button>{{ request()->user()->isLikedComment($comment) ? 'unLike' : 'Like' }}</button>
            </form>
            <form action=""></form>
            <form action="{{ route('prompt.comment.delete', ['prompt' => $prompt, 'comment' => $comment]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>
                    delete
                </button>
            </form>
            <br>
        @endforeach
    </div>
    <a href="{{ route('prompt.index') }}">home</a>
</div>
