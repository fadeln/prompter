<div>
    <form action="{{ route('prompt.update', $prompt) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="prompt" id="" cols="30" rows="10">{{ $prompt->prompt }}</textarea>

        <!-- Category Selection -->
        <div>
            @foreach ($categories as $category)
                <label>
                    {{ $category->title }}
                    <input type="radio" name="category_id" value="{{ $category->id }}" {{ $category->id == $prompt->category_id ? 'checked' : '' }}>
                </label>
            @endforeach
        </div>

        <!-- Tag Input -->
        <label for="tags">Enter Tags:</label>
        <input type="text" name="tags" id="tags" placeholder="e.g., #programming #web" value="{{ $prompt->tags->pluck('name')->implode(' ') }}">

        <!-- Image URL Input -->
        <label for="image_url">Enter Image URL:</label>
        <input type="text" name="image_url" id="image_url" placeholder="e.g., https://www.example.com/" value="{{ optional($prompt->image)->url }}">

        <!-- Cancel Button -->
        <a href="{{ route('prompt.index') }}">Cancel</a>

        <!-- Submit Button -->
        <button type="submit">Submit</button>
    </form>
</div>
