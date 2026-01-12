@extends('layouts.app2')

@section('title', 'V75 Pro - Mon Compte')

@section('page-title', 'MON COMPTE')
@section('page-subtitle', 'GÉRER MON COMPTE')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-3">
            <h3 class="text-sm font-bold text-gray-900 uppercase">INFORMATIONS COMPTE</h3>
        </div>
        <div class="p-4">
            <form method="POST" action="{{ route('client.account_usdt') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-mono text-gray-500 mb-2">ADRESSE USDT TRC20</label>
                    <input type="text" name="usdt_address" value="{{ auth('client')->user()->usdt_address ?? '' }}" 
                           class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
                </div>
                <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                    ENREGISTRER
                </button>
            </form>
        </div>
    </div>
    
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-3">
            <h3 class="text-sm font-bold text-gray-900 uppercase">SOLDE</h3>
        </div>
        <div class="p-4">
            <div class="mb-4">
                <p class="text-xs text-gray-500 font-mono mb-1">SOLDE DISPONIBLE</p>
                <p class="text-3xl font-bold text-gray-900">${{ number_format(auth('client')->user()->wallet->balance ?? 0, 2) }}</p>
            </div>
            <div class="space-y-2">
                <a href="{{ route('client.deposit') }}" class="block text-center text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                    DÉPOSER
                </a>
                <a href="{{ route('client.withdrawal') }}" class="block text-center text-xs font-mono bg-gray-200 text-gray-900 px-4 py-2 hover:bg-gray-300 border-2 border-gray-300">
                    RETIRER
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
