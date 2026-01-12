@extends('layouts.app2')

@section('title', 'V75 Pro - QR Code')

@section('page-title', 'QR CODE')
@section('page-subtitle', 'SCANNER LE QR CODE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">QR CODE</h3>
    </div>
    <div class="p-8 text-center">
        @if(isset($qrCode))
            <div class="mb-4">
                {!! $qrCode !!}
            </div>
            <p class="text-xs text-gray-500 font-mono">Scannez ce code pour effectuer le paiement</p>
        @else
            <p class="text-xs text-gray-500 font-mono">AUCUN QR CODE DISPONIBLE</p>
        @endif
    </div>
</div>

@endsection

