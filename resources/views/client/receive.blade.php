@extends('layouts.app2')

@section('title', 'V75 Pro - Recevoir')

@section('page-title', 'RECEVOIR')
@section('page-subtitle', 'RECEVOIR DES FONDS')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">RECEVOIR DES FONDS</h3>
    </div>
    <div class="p-4">
        <div class="mb-4">
            <p class="text-xs font-mono text-gray-500 mb-2">VOTRE ADRESSE</p>
            <div class="border-2 border-gray-300 p-3 bg-gray-50">
                <p class="text-xs font-mono text-gray-900">{{ auth('client')->user()->usdt_address ?? 'NON CONFIGURÉ' }}</p>
            </div>
        </div>
        <div class="mb-4">
            <p class="text-xs font-mono text-gray-500 mb-2">CODE DE PARRAINAGE</p>
            <div class="border-2 border-gray-300 p-3 bg-gray-50">
                <p class="text-xs font-mono text-gray-900">{{ auth('client')->user()->referral_code ?? 'N/A' }}</p>
            </div>
        </div>
        <a href="{{ route('client.account') }}" class="text-xs font-mono bg-gray-200 text-gray-900 px-4 py-2 hover:bg-gray-300 border-2 border-gray-300">
            CONFIGURER L'ADRESSE
        </a>
    </div>
</div>

@endsection

