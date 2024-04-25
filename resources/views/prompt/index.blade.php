@extends('layouts.prompt')
@section('content')
    <div>
        <div class="container">
            <a href="{{ route('prompt.create') }}">
                <button class="btn btn-success my-4">Post your prompt</button>
            </a>
            <div class="row">
                @foreach ($prompts as $prompt)
                    <div class="col-12 my-4">
                        <div class="card">
                        
                            <div class="border-spacing-1 border-blue-300 border-solid card-body">
                                <button class="btn btn-link copy-prompt position-absolute top-0 end-0" data-prompt="{{ $prompt->prompt }}">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <p class="my-0"><strong>Author:</strong> {{ $prompt->user->name }}</p>
                                <p><strong>Category:</strong> {{ $prompt->category->title }}</p>
                                <p class="font-weight-bold">{{ $prompt->prompt }}</p>
                                @if ($prompt->image)
                                    <p><strong>Image URL:</strong> {{ $prompt->image->url }}</p>
                                @endif
                                <div class="row justify-content-between">
                                    @if ($prompt->tags->isNotEmpty())
                                        <div class="col-8">
                                            <button class="btn btn-link m-0 p-0">
                                                @foreach ($prompt->tags as $tag)
                                                    {{ $tag->name }}
                                                @endforeach
                                            </button>
                                        </div>
                                    @endif
                                    @auth
                                        <div class="col-md-2 col-12 row">
                                            <form
                                                action="{{ request()->user()->isFavorited($prompt) ? route('prompt.unfavorite', $prompt) : route('prompt.favorite', $prompt) }}"
                                                method="POST"
                                                class="col-md-6 col-12 d-flex align-items-center justify-content-md-end">
                                                @csrf
                                                @method(request()->user()->isFavorited($prompt) ? 'DELETE' : 'POST')

                                                <button type="submit" class="btn btn-link">
                                                    @if (request()->user()->isFavorited($prompt))
                                                        <i class="fa-solid fa-star"></i>
                                                    @else
                                                        <i class="fa-regular fa-star"></i>
                                                    @endif
                                                </button>

                                                <div class="col-2">
                                                    <p class="mb-0 fw-bolder"> {{ $prompt->favorites()->count() }}</p>
                                                </div>
                                            </form>
                                            <x-like-button :prompt="$prompt" />
                                        </div>
                                    @endauth

                                </div>



                                <div class="row justify-content-between mt-4">
                                    <div class="col-8">
                                        <a href="{{ route('prompt.show', $prompt) }}"><button
                                                class="btn btn-primary">Details</button></a>
                                        <a href="{{ route('prompt.edit', $prompt) }}">
                                            <button class="btn btn-warning">Edit</button>
                                        </a>
                                    </div>

                                    <form action="{{ route('prompt.destroy', $prompt) }}" method="POST"
                                        class="col-4 d-flex align-items-end flex-column">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyButtons = document.querySelectorAll('.copy-prompt');
            copyButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const promptContent = this.getAttribute('data-prompt');
                    copyToClipboard(promptContent);
                });
            });

            function copyToClipboard(text) {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                alert('Prompt content copied to clipboard!');
            }
        });

    </script>
@endsection
