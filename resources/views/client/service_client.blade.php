@extends('layouts.app2')

@section('title', 'V75 Pro - Service Client')

@section('page-title', 'SERVICE CLIENT')
@section('page-subtitle', 'MES MESSAGES')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3 flex justify-between items-center">
        <h3 class="text-sm font-bold text-gray-900 uppercase">MES MESSAGES</h3>
        <a href="{{ route('client.message') }}" class="text-xs font-mono bg-gray-800 text-white px-3 py-1 hover:bg-gray-900">
            NOUVEAU MESSAGE
        </a>
    </div>
    <div class="p-4">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">#</th>
                    <th class="text-left py-2 font-mono text-gray-500">SUJET</th>
                    <th class="text-left py-2 font-mono text-gray-500">DATE</th>
                    <th class="text-left py-2 font-mono text-gray-500">STATUS</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages ?? [] as $message)
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2 text-gray-900">{{ $message->subject ?? 'N/A' }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2">
                            @if($message->status == 'read')
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1">LU</span>
                            @else
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1">NON LU</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <a href="{{ route('client.messages.show', $message->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300">VOIR</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500 font-mono text-xs">AUCUN MESSAGE</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

