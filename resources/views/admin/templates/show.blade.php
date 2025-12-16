@extends('layouts.admin')

@section('title', $template['title'])
@section('page-title', 'Template Preview')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-semibold">
        {{ $template['title'] }}
    </h1>
    <p class="text-sm text-gray-500">
        Preview of the invitation template.
    </p>
</div>

<div class="bg-white rounded-xl p-8 border shadow-sm">
    {!! $template['content'] !!}
</div>

<div class="mt-6">
    <a href="{{ route('admin.templates.index') }}"
       class="text-sm text-gray-600 hover:underline">
        ← Back to Templates
    </a>
</div>

@endsection
