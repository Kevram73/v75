@extends('layouts.app')

@section('title', 'V75 Pro - Profil')

@section('page-title', 'PROFIL')
@section('page-subtitle', 'GÉRER MON COMPTE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">MON PROFIL</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('admin.change_password') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">NOUVEAU MOT DE PASSE</label>
                <input type="password" name="password" class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                CHANGER LE MOT DE PASSE
            </button>
        </form>
    </div>
</div>

@endsection
