@extends('layouts.prompt')

@section('content')
    <div class="container">
        <h1>Favorite Prompts</h1>
        @foreach ($prompts as $prompt)
            <!-- Render each favorite prompt -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $prompt->prompt }}</h5>
                    <!-- Add more details as needed -->
                </div>
            </div>
        @endforeach
        <!-- Add pagination links if needed -->
        {{ $prompts->links() }}
    </div>
@endsection
