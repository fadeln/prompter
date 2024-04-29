@extends('layouts.prompt')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Prompt') }}</div>
                    <div class="card-body">
                        <form action="{{ route('prompt.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">{{ __('PromptTitle Content') }}</label>
                                <input type="text" class="form-control" id="judul" name="judul" rows="5"></input>
                            </div>

                            <div class="mb-3">
                                <label for="prompt" class="form-label">{{ __('Prompt Content') }}</label>
                                <textarea class="form-control" id="prompt" name="prompt" rows="5"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('Category') }}</label>
                                <div>
                                    @foreach ($categories as $category)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kategori_id" id="category{{ $category->id }}" value="{{ $category->id }}">
                                            <label class="form-check-label" for="category{{ $category->id }}">{{ $category->judul }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="tags" class="form-label">{{ __('Tags') }}</label>
                                <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g., #programming #web">
                            </div>
                            
                            <div class="mb-3">
                                <label for="image_url" class="form-label">{{ __('Image URL') }}</label>
                                <input type="text" class="form-control" id="image_url" name="image_url" placeholder="e.g., https://www.example.com/">
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('prompt.index') }}" class="btn btn-secondary me-md-2">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
@endsection

