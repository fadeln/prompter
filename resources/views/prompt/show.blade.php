@extends('layouts.prompt')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Prompt Details') }}</div>
                <div class="card-body">
                    <p>{{ $prompt->prompt }}</p>
                    
                    <div class="my-3">
                        <form action="{{ route('prompt.comment.store', $prompt) }}" method="post">
                            @csrf
                            <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Add a comment"></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
                        </form>
                    </div>
                    <hr>
                    <div>
                        @foreach ($prompt->comments as $comment)
                            <div class="mb-3">
                                <div>
                                    <strong>Comment by:</strong> {{ $comment->user->name }}
                                </div>
                                <div>
                                    <p>{{ $comment->comment }}</p>
                                    <p><strong>Likes:</strong> {{ $comment->likes()->count() }}</p>
                                </div>
                                <div>
                                    <form action="{{ request()->user()->isLikedComment($comment) ? route('comment.unlike', $comment) : route('comment.like', $comment) }}" method="POST">
                                        @csrf
                                        @method(request()->user()->isLikedComment($comment) ? 'DELETE' : 'POST')
                                        <button type="submit" class="btn btn-link">{{ request()->user()->isLikedComment($comment) ? 'Unlike' : 'Like' }}</button>
                                    </form>
                                    <form action="{{ route('prompt.comment.delete', ['prompt' => $prompt, 'comment' => $comment]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div>
                        <a href="{{ route('prompt.index') }}" class="btn btn-secondary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
