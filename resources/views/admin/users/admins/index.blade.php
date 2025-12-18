@extends('layouts.admin')

@section('page-title', 'Admins')

@section('content')
<h1 class="text-xl font-semibold mb-4">Admins</h1>

<table class="w-full bg-white rounded shadow text-sm">
    <thead>
        <tr class="border-b">
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
        <tr class="border-b last:border-0">
            <td class="p-3">{{ $admin->name }}</td>
            <td class="p-3">{{ $admin->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
