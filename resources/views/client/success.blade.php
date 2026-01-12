@extends('layouts.app2')

@section('title', 'V75 Pro - Succès')

@section('page-title', 'SUCCÈS')
@section('page-subtitle', 'OPÉRATION RÉUSSIE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="p-8 text-center">
        <div class="w-16 h-16 bg-gray-800 flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-white text-2xl"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2 uppercase">OPÉRATION RÉUSSIE</h3>
        <p class="text-xs text-gray-500 font-mono mb-6">Votre opération a été effectuée avec succès</p>
        <a href="{{ route('client.dashboard') }}" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
            RETOUR AU DASHBOARD
        </a>
    </div>
</div>

@endsection

