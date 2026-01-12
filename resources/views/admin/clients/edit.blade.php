@extends('layouts.app')

@section('title', 'V75 Pro - Éditer Client')

@section('page-title', 'ÉDITER CLIENT')
@section('page-subtitle', 'MODIFIER LE CLIENT')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">ÉDITER LE CLIENT</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('admin.clients.update', $client->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">NOM</label>
                <input type="text" name="last_name" value="{{ $client->last_name }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">PRÉNOM</label>
                <input type="text" name="first_name" value="{{ $client->first_name }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">EMAIL</label>
                <input type="email" name="email" value="{{ $client->email }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">TÉLÉPHONE</label>
                <input type="text" name="phone_number" value="{{ $client->phone_number }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                ENREGISTRER
            </button>
        </form>
    </div>
</div>

@endsection

