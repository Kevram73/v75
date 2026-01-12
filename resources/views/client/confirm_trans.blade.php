@extends('layouts.app2')

@section('title', 'V75 Pro - Confirmer Transaction')

@section('page-title', 'CONFIRMER')
@section('page-subtitle', 'CONFIRMER LA TRANSACTION')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">CONFIRMER LA TRANSACTION</h3>
    </div>
    <div class="p-4">
        <div class="mb-4">
            <p class="text-xs font-mono text-gray-500 mb-2">MONTANT</p>
            <p class="text-lg font-bold text-gray-900">${{ number_format($amount ?? 0, 2) }}</p>
        </div>
        <form method="POST" action="{{ route('client.transfer.process') }}">
            @csrf
            <input type="hidden" name="amount" value="{{ $amount ?? 0 }}">
            <input type="hidden" name="email" value="{{ $email ?? '' }}">
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                CONFIRMER
            </button>
        </form>
    </div>
</div>

@endsection

