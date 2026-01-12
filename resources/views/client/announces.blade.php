@extends('layouts.app2')

@section('title', 'V75 Pro - Actualités')

@section('page-title', 'ACTUALITÉS')
@section('page-subtitle', 'ANNONCES ET NOUVELLES')

@section('content')

<div class="space-y-4">
    @forelse($announcements ?? [] as $announcement)
        <div class="bg-white border-2 border-gray-300">
            <div class="border-b-2 border-gray-300 p-3">
                <h3 class="text-sm font-bold text-gray-900 uppercase">{{ $announcement->title ?? 'SANS TITRE' }}</h3>
                <p class="text-xs text-gray-500 font-mono mt-1">{{ $announcement->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="p-4">
                @if($announcement->image)
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="mb-4 w-full">
                @endif
                <div class="text-xs text-gray-700 whitespace-pre-line">{{ $announcement->content ?? '' }}</div>
            </div>
        </div>
    @empty
        <div class="bg-white border-2 border-gray-300 p-8 text-center">
            <p class="text-xs text-gray-500 font-mono">AUCUNE ANNONCE</p>
        </div>
    @endforelse
</div>

@endsection

