@extends('layouts.prompt')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Prompt') }}</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'prompt.store', 'method' => 'POST']) !!}
                            <div class="mb-3">
                                {!! Form::label('judul', __('Prompt Title Content'), ['class' => 'form-label']) !!}
                                {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="mb-3">
                                {!! Form::label('prompt', __('Prompt Content'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('prompt', null, ['class' => 'form-control', 'rows' => 5]) !!}
                            </div>
                            
                            <div class="mb-3">
                                {!! Form::label('category', __('Category'), ['class' => 'form-label']) !!}
                                <div>
                                    @foreach ($categories as $category)
                                        <div class="form-check form-check-inline">
                                            {!! Form::radio('kategori_id', $category->id, null, ['class' => 'form-check-input', 'id' => 'category'.$category->id]) !!}
                                            {!! Form::label('category'.$category->id, $category->judul, ['class' => 'form-check-label']) !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                {!! Form::label('label', __('Tags'), ['class' => 'form-label']) !!}
                                {!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => __('e.g., #programming #web')]) !!}
                            </div>
                            
                            <div class="mb-3">
                                {!! Form::label('image_url', __('Image URL'), ['class' => 'form-label']) !!}
                                {!! Form::text('image_url', null, ['class' => 'form-control', 'placeholder' => __('e.g., https://www.example.com/')]) !!}
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                {!! Form::submit(__('Create'), ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('prompt.index') }}" class="btn btn-secondary me-md-2">{{ __('Cancel') }}</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>   
@endsection
