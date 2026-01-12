@extends('layouts.app2')

@section('title', 'V75 Pro - Changer Mot de Passe Retrait')

@section('page-title', 'CHANGER MOT DE PASSE')
@section('page-subtitle', 'MOT DE PASSE DE RETRAIT')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">CHANGER LE MOT DE PASSE DE RETRAIT</h3>
    </div>
    <div class="p-4">
        <form method="POST" action="{{ route('client.withdrawal.password.update') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">ANCIEN MOT DE PASSE</label>
                <input type="password" name="old_withdrawal_password" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">NOUVEAU MOT DE PASSE</label>
                <input type="password" name="withdrawal_password" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <div class="mb-4">
                <label class="block text-xs font-mono text-gray-500 mb-2">CONFIRMER LE NOUVEAU MOT DE PASSE</label>
                <input type="password" name="withdrawal_password_confirmation" required class="w-full px-3 py-2 border-2 border-gray-300 text-xs font-mono focus:border-gray-800">
            </div>
            <button type="submit" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                CHANGER
            </button>
        </form>
    </div>
</div>

@endsection

