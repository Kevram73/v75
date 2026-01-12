@extends('layouts.app')

@section('title', 'V75 Pro - Détails Message')

@section('page-title', 'DÉTAILS MESSAGE')
@section('page-subtitle', 'INFORMATIONS MESSAGE')

@section('content')

<div class="space-y-6">
    <!-- Message du client -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">MESSAGE DU CLIENT</h3>
        </div>
        <div class="p-4 md:p-6">
            <div class="space-y-4">
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">CLIENT</p>
                    <p class="text-sm text-gray-900 font-medium">{{ $message->client->first_name ?? 'N/A' }} {{ $message->client->last_name ?? '' }}</p>
                    <p class="text-xs text-gray-500 font-mono">{{ $message->client->email ?? '' }}</p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">SUJET</p>
                    <p class="text-sm text-gray-900 font-medium">{{ $message->subject ?? $message->object ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">DATE</p>
                    <p class="text-sm text-gray-900 font-mono">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-2">MESSAGE</p>
                    <div class="border-2 border-gray-300 p-4 bg-gray-50 rounded">
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $message->message ?? $message->content ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Réponse existante -->
    @if($message->response)
        <div class="bg-green-50 border-2 border-green-300">
            <div class="border-b-2 border-green-300 p-4">
                <h3 class="text-sm font-bold text-green-900 uppercase">
                    <i class="fas fa-reply mr-2"></i>RÉPONSE ENVOYÉE
                </h3>
            </div>
            <div class="p-4 md:p-6">
                <div class="mb-4">
                    <p class="text-xs font-mono text-gray-500 mb-1">DATE DE RÉPONSE</p>
                    <p class="text-sm text-gray-900 font-mono">{{ $message->response_date ? \Carbon\Carbon::parse($message->response_date)->format('d/m/Y à H:i') : '' }}</p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-2">RÉPONSE</p>
                    <div class="border-2 border-green-300 p-4 bg-white rounded">
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $message->response }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Formulaire de réponse -->
        <div class="bg-white border-2 border-gray-300">
            <div class="border-b-2 border-gray-300 p-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase">
                    <i class="fas fa-reply mr-2"></i>RÉPONDRE AU MESSAGE
                </h3>
            </div>
            <div class="p-4 md:p-6">
                <form method="POST" action="{{ route('admin.messages.update', $message->id) }}">
                    @csrf
                    @method('PUT')
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-50 border-l-4 border-green-600 p-3 border border-green-200">
                            <div class="flex items-center">
                                <span class="text-green-600 mr-2 font-mono">[OK]</span>
                                <p class="text-xs font-medium text-gray-900">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 bg-red-50 border-l-4 border-red-600 p-3 border border-red-200">
                            <div class="flex items-start">
                                <span class="text-red-600 mr-2 font-mono">[ERR]</span>
                                <div>
                                    <p class="text-xs font-medium text-gray-900 mb-1">Erreurs de validation:</p>
                                    <ul class="list-disc list-inside text-xs text-gray-700">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="response" class="block text-xs font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment-alt mr-1"></i>VOTRE RÉPONSE
                        </label>
                        <textarea id="response"
                                  name="response" 
                                  rows="8" 
                                  required 
                                  class="w-full px-3 py-2 border-2 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 @error('response') border-red-500 @enderror"
                                  placeholder="Écrivez votre réponse ici...">{{ old('response') }}</textarea>
                        @error('response')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.messages.index') }}" class="text-xs font-medium text-gray-600 hover:text-gray-900">
                            <i class="fas fa-arrow-left mr-1"></i>RETOUR À LA LISTE
                        </a>
                        <button type="submit" class="text-xs font-medium bg-gray-800 text-white px-6 py-2 hover:bg-gray-900 transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>ENVOYER LA RÉPONSE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

@endsection

