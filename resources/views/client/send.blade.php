@extends('layouts.app2')

@section('title', 'V75 Pro - Envoyer')

@section('page-title', 'ENVOYER')
@section('page-subtitle', 'ENVOYER DES FONDS')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">ENVOYER DES FONDS</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('client.transfer.process') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">DESTINATAIRE (EMAIL)</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">MONTANT</label>
                <input type="number" name="amount" step="0.01" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                ENVOYER
            </button>
        </form>
    </div>
</div>

@endsection

