<form
    action="{{ request()->user()->isLikedPrompt($prompt) ? route('prompt.unlike', $prompt) : route('prompt.like', $prompt) }}"
    method="POST" class="col-md-6 col-12 d-flex align-items-center justify-content-md-end">
    @csrf
    @method(request()->user()->isLikedPrompt($prompt) ? 'DELETE' : 'POST')
    <button type="submit" class="btn btn-link">
        @if (request()->user()->isLikedPrompt($prompt))
            <i class="fa-solid fa-thumbs-up"></i>
        @else
            <i class="fa-regular fa-thumbs-up"></i>
        @endif
    </button>

    <div class="col-2">
        <p class="mb-0 fw-bolder">{{ $prompt->likes()->count() }}</p>
    </div>
</form>
