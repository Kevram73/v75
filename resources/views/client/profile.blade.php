@extends('layouts.app2')

@section('title', 'V75 Pro - Mon Profil')

@section('page-title', 'PROFIL')
@section('page-subtitle', 'GÉRER MON PROFIL')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">MON PROFIL</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('client.profile.update') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">NOM</label>
                <input type="text" name="last_name" value="{{ auth('client')->user()->last_name }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">PRÉNOM</label>
                <input type="text" name="first_name" value="{{ auth('client')->user()->first_name }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">EMAIL</label>
                <input type="email" name="email" value="{{ auth('client')->user()->email }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">TÉLÉPHONE</label>
                <input type="text" name="phone_number" value="{{ auth('client')->user()->phone_number }}" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                ENREGISTRER
            </button>
        </form>
    </div>
</div>

@endsection

