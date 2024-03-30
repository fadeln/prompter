<div>
    <p>
        {{ $prompt->prompt }}
    </p>
    <div>
        @foreach ($prompt->comments as $comment)
            <br>
            comment by : {{ $comment->user->name }}
            <p>
                {{ $comment->comment }}
            </p>
            <br>
        @endforeach
    </div>
    <a href="{{ route('prompt.index') }}">home</a>
</div>
