@extends('layouts.app')

@section('title', 'V75 Pro - Messages')

@section('page-title', 'MESSAGES')
@section('page-subtitle', 'MESSAGES CLIENTS')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-4 flex justify-between items-center">
        <h3 class="text-sm font-bold text-gray-900 uppercase">MESSAGES CLIENTS</h3>
        <div class="text-xs text-gray-500 font-mono">
            Total: {{ $messages->total() ?? 0 }} message(s)
        </div>
    </div>
    <div class="p-4 overflow-x-auto">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">#</th>
                    <th class="text-left py-2 font-mono text-gray-500">CLIENT</th>
                    <th class="text-left py-2 font-mono text-gray-500">SUJET</th>
                    <th class="text-left py-2 font-mono text-gray-500">DATE</th>
                    <th class="text-left py-2 font-mono text-gray-500">STATUS</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages ?? [] as $message)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2 text-gray-900">
                            {{ $message->client->first_name ?? 'N/A' }} {{ $message->client->last_name ?? '' }}
                            <br>
                            <span class="text-xs text-gray-500 font-mono">{{ $message->client->email ?? '' }}</span>
                        </td>
                        <td class="py-2 text-gray-900">{{ $message->subject ?? $message->object ?? 'N/A' }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2">
                            @if($message->response)
                                <span class="font-mono text-xs bg-green-100 text-green-800 px-2 py-1 rounded">RÉPONDU</span>
                            @else
                                <span class="font-mono text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">EN ATTENTE</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300 rounded">
                                VOIR
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUN MESSAGE</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if(isset($messages) && method_exists($messages, 'links'))
            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>

@endsection

