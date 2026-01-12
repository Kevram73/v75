@extends('layouts.app2')

@section('title', 'V75 Pro - Réponses')

@section('page-title', 'RÉPONSES')
@section('page-subtitle', 'MESSAGES ET RÉPONSES')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-bold text-gray-900 uppercase">MES MESSAGES</h3>
            <p class="text-xs text-gray-500 font-mono mt-1">Historique de vos échanges avec le support</p>
        </div>
        <a href="{{ route('client.message.create') }}" class="text-xs font-medium bg-gray-800 text-white px-4 py-2 hover:bg-gray-900 transition-colors">
            <i class="fas fa-plus mr-2"></i>NOUVEAU MESSAGE
        </a>
    </div>

    <div class="space-y-4">
        @forelse($messages ?? [] as $message)
            <div class="bg-white border-2 border-gray-300">
                <div class="border-b-2 border-gray-300 p-4">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="text-sm font-bold text-gray-900 uppercase">{{ $message->subject ?? $message->object ?? 'SANS SUJET' }}</h3>
                                @if($message->response)
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 font-mono rounded">RÉPONDU</span>
                                @else
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 font-mono rounded">EN ATTENTE</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 font-mono">
                                <i class="fas fa-clock mr-1"></i>{{ $message->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-4 md:p-6 space-y-4">
                    <div>
                        <h6 class="text-xs font-bold text-gray-700 mb-2 uppercase flex items-center">
                            <i class="fas fa-envelope mr-2"></i>VOTRE MESSAGE
                        </h6>
                        <div class="text-xs text-gray-700 whitespace-pre-line bg-gray-50 p-4 border border-gray-200 rounded">
                            {{ $message->message ?? $message->content ?? '' }}
                        </div>
                    </div>
                    
                    @if($message->response)
                        <div>
                            <h6 class="text-xs font-bold text-green-700 mb-2 uppercase flex items-center">
                                <i class="fas fa-reply mr-2"></i>RÉPONSE DU SUPPORT
                            </h6>
                            <div class="text-xs text-gray-700 whitespace-pre-line bg-green-50 p-4 border border-green-200 rounded">
                                {{ $message->response }}
                            </div>
                            <p class="text-xs text-gray-500 font-mono mt-2">
                                <i class="fas fa-calendar-check mr-1"></i>
                                Répondu le: {{ $message->response_date ? \Carbon\Carbon::parse($message->response_date)->format('d/m/Y à H:i') : '' }}
                            </p>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3">
                            <p class="text-xs text-yellow-800">
                                <i class="fas fa-hourglass-half mr-1"></i>
                                Votre message est en attente de réponse de notre équipe.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white border-2 border-gray-300 p-12 text-center">
                <i class="fas fa-inbox text-gray-300 text-4xl mb-4"></i>
                <p class="text-sm text-gray-500 font-mono mb-4">AUCUN MESSAGE</p>
                <a href="{{ route('client.message.create') }}" class="text-xs font-medium bg-gray-800 text-white px-6 py-2 hover:bg-gray-900 transition-colors inline-block">
                    <i class="fas fa-plus mr-2"></i>ENVOYER UN MESSAGE
                </a>
            </div>
        @endforelse
    </div>
</div>

@endsection

