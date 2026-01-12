@extends('layouts.app')

@section('title', 'V75 Pro - Éditer Annonce')

@section('page-title', 'ÉDITER ANNONCE')
@section('page-subtitle', 'MODIFIER L\'ANNONCE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">ÉDITER L'ANNONCE</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">TITRE</label>
                <input type="text" name="title" value="{{ $announcement->title }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">CONTENU</label>
                <textarea name="content" rows="10" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">{{ $announcement->content }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">IMAGE</label>
                @if($announcement->image)
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="mb-2 w-32">
                @endif
                <input type="file" name="image" class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                ENREGISTRER
            </button>
        </form>
    </div>
</div>

@endsection

