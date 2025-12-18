@extends('layouts.admin')

@section('title', 'Invitation Templates | FILKOMIN')
@section('page-title', 'Invitation Templates')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-semibold mb-1">
        Invitation Templates
    </h1>
    <p class="text-sm text-gray-500">
        Official invitation templates managed by administrator.
    </p>
</div>

<!-- TEMPLATE GRID -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@forelse ($templates as $template)
    <div class="bg-white rounded-xl p-6 border shadow-sm flex flex-col justify-between">

        <!-- TOP -->
        <div>
            <!-- STATUS BADGE -->
            <span class="inline-block text-xs px-3 py-1 rounded-full
                {{ $template->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                {{ $template->is_active ? 'Active' : 'Inactive' }}
            </span>

            <!-- TITLE -->
            <h3 class="text-lg font-semibold mt-4">
                {{ $template->title }}
            </h3>

            <!-- CATEGORY -->
            <p class="text-xs uppercase tracking-wide text-gray-400 mt-1">
                {{ $template->category }}
            </p>

            <!-- DESCRIPTION -->
            <p class="text-sm text-gray-600 mt-3">
                {{ $template->description }}
            </p>
        </div>

        <!-- ACTIONS -->
        <div class="mt-6 flex items-center justify-between gap-2">

            <!-- PREVIEW -->
            <a href="{{ route('admin.templates.preview', $template->id) }}"
               class="px-4 py-2 text-sm rounded-lg border border-[#4A3E3E]
                      text-[#4A3E3E] hover:bg-[#4A3E3E] hover:text-white transition">
                Preview
            </a>

            <!-- TOGGLE -->
            <form method="POST"
                  action="{{ route('admin.templates.toggle', $template->id) }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 text-sm rounded-lg border
                    {{ $template->is_active
                        ? 'border-red-300 text-red-600 hover:bg-red-50'
                        : 'border-green-300 text-green-600 hover:bg-green-50' }}">
                    {{ $template->is_active ? 'Deactivate' : 'Activate' }}
                </button>
            </form>

        </div>
    </div>
@empty
    <div class="col-span-3 text-center py-12 text-gray-500">
        No templates available.
    </div>
@endforelse

</div>

@endsection
