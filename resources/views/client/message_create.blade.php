@extends('layouts.app2')

@section('title', 'V75 Pro - Contacter le Support')

@section('page-title', 'MESSAGERIE')
@section('page-subtitle', 'ÉCRIRE AU SUPPORT')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">
                <i class="fas fa-envelope mr-2"></i>ÉCRIRE À V75 PRO
            </h3>
        </div>
        <div class="p-4 md:p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-50 border-l-4 border-green-600 p-3 border border-green-200">
                    <div class="flex items-center">
                        <span class="text-green-600 mr-2 font-mono">[OK]</span>
                        <p class="text-xs font-medium text-gray-900">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-600 p-3 border border-red-200">
                    <div class="flex items-center">
                        <span class="text-red-600 mr-2 font-mono">[ERR]</span>
                        <p class="text-xs font-medium text-gray-900">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('client.message_send') }}">
                @csrf
                <div class="mb-4">
                    <label for="subject" class="block text-xs font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag mr-1"></i>SUJET
                    </label>
                    <input type="text" 
                           id="subject"
                           name="subject" 
                           value="{{ old('subject') }}"
                           required 
                           class="w-full px-3 py-2 border-2 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 @error('subject') border-red-500 @enderror"
                           placeholder="Sujet de votre message">
                    @error('subject')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-xs font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-alt mr-1"></i>MESSAGE
                    </label>
                    <textarea id="message"
                              name="message" 
                              rows="10" 
                              required 
                              class="w-full px-3 py-2 border-2 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 @error('message') border-red-500 @enderror"
                              placeholder="Écrivez votre message ici...">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('client.response') }}" class="text-xs font-medium text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left mr-1"></i>Voir mes messages
                    </a>
                    <button type="submit" class="text-xs font-medium bg-gray-800 text-white px-6 py-2 hover:bg-gray-900 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>ENVOYER
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 mr-2 mt-1"></i>
            <div class="text-xs text-gray-700">
                <p class="font-semibold mb-1">Information:</p>
                <p>Votre message sera traité par notre équipe de support. Vous recevrez une réponse dans la section "RÉPONSES" de votre compte.</p>
            </div>
        </div>
    </div>
</div>

@endsection

