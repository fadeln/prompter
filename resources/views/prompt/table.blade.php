@extends('layouts.prompt')
 
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Manage Prompts</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush