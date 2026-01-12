@extends('layouts.app')

@section('title', 'V75 Pro - Annonces')

@section('page-title', 'ANNONCES')
@section('page-subtitle', 'GESTION DES ANNONCES')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3 flex justify-between items-center">
        <h3 class="text-sm font-bold text-gray-900 uppercase">LISTE DES ANNONCES</h3>
        <a href="{{ route('admin.announcements.create') }}" class="text-xs font-mono bg-gray-800 text-white px-3 py-1 hover:bg-gray-900">
            CRÉER UNE ANNONCE
        </a>
    </div>
    <div class="p-4">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">#</th>
                    <th class="text-left py-2 font-mono text-gray-500">TITRE</th>
                    <th class="text-left py-2 font-mono text-gray-500">DATE</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements ?? [] as $announcement)
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2 text-gray-900">{{ $announcement->title ?? 'N/A' }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $announcement->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300">ÉDITER</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUNE ANNONCE</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

