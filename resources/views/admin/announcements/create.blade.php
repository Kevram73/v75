@extends('layouts.app')

@section('title', 'V75 Pro - Créer Annonce')

@section('page-title', 'CRÉER ANNONCE')
@section('page-subtitle', 'NOUVELLE ANNONCE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">CRÉER UNE ANNONCE</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('admin.announcements.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">TITRE</label>
                <input type="text" name="title" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">CONTENU</label>
                <textarea name="content" rows="10" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">IMAGE</label>
                <input type="file" name="image" class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                CRÉER
            </button>
        </form>
    </div>
</div>

@endsection

