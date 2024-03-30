<div>
    <form action="{{ route('prompt.store') }}" method="POST" style="flex-direction: column; display: flex; margin: 10%">
        @csrf
        <textarea name="prompt" cols="30" rows="10"></textarea>

        <div>
            @foreach ($categories as $category)
                <label>
                    {{ $category->title }}
                    <input type="radio" name="category_id" value="{{ $category->id }}">
                </label>
            @endforeach
        </div>

        <label for="tags">Enter Tags:</label>
        <input type="text" name="tags" id="tags" placeholder="e.g., #programming #web">

        <label for="image_url">Enter Image URL:</label>
        <input type="text" name="image_url" id="image_url" placeholder="e.g., https://www.example.com/">

        <div>
            <a href="{{ route('prompt.index') }}">Cancel</a>
            <button type="submit">Create</button>
        </div>
    </form>
</div>
