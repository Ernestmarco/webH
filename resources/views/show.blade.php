@extends('layouts.app')

@section('title', $character['name'] . ' — Wiki-Rick')

@section('content')

    {{-- Botón volver --}}
    <div class="mb-6">
        <a href="{{ route('characters.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-portal-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver al listado
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gray-900 rounded-2xl border border-gray-800 overflow-hidden shadow-2xl">

            {{-- Top section: imagen + info principal --}}
            <div class="md:flex">
                {{-- Imagen --}}
                <div class="md:w-1/3 flex-shrink-0">
                    <img
                        src="{{ $character['image'] }}"
                        alt="{{ $character['name'] }}"
                        class="w-full h-72 md:h-full object-cover"
                    >
                </div>

                {{-- Datos principales --}}
                <div class="flex-1 p-6 md:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <h1 class="text-3xl font-extrabold text-white">
                            {{ $character['name'] }}
                        </h1>
                        @php
                            $statusColor = match($character['status']) {
                                'Alive'   => 'bg-emerald-500',
                                'Dead'    => 'bg-red-500',
                                default   => 'bg-yellow-500',
                            };
                            $statusLabel = match($character['status']) {
                                'Alive'   => 'Vivo',
                                'Dead'    => 'Muerto',
                                default   => 'Desconocido',
                            };
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-white {{ $statusColor }} shadow">
                            <span class="w-2 h-2 rounded-full bg-white/40 animate-pulse"></span>
                            {{ $statusLabel }}
                        </span>
                    </div>

                    {{-- Meta info --}}
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Especie</p>
                            <p class="mt-1 text-sm font-semibold text-portal-400">{{ $character['species'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Tipo</p>
                            <p class="mt-1 text-sm font-semibold text-gray-200">{{ $character['type'] ?: '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Género</p>
                            <p class="mt-1 text-sm font-semibold text-gray-200">
                                @php
                                    $genderLabel = match($character['gender']) {
                                        'Male'       => '♂ Masculino',
                                        'Female'     => '♀ Femenino',
                                        'Genderless' => '⚬ Sin género',
                                        default      => '? Desconocido',
                                    };
                                @endphp
                                {{ $genderLabel }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-gray-500">Origen</p>
                            <p class="mt-1 text-sm font-semibold text-gray-200">{{ $character['origin']['name'] }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-xs uppercase tracking-wider text-gray-500">Última ubicación</p>
                            <p class="mt-1 text-sm font-semibold text-gray-200">{{ $character['location']['name'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Episodios --}}
            <div class="border-t border-gray-800 p-6 md:p-8">
                <h2 class="text-lg font-bold text-white mb-4">
                    📺 Episodios ({{ count($character['episode']) }})
                </h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($character['episode'] as $episodeUrl)
                        @php
                            $episodeNumber = basename($episodeUrl);
                        @endphp
                        <span class="inline-block px-3 py-1.5 rounded-lg bg-gray-800 text-xs font-semibold text-gray-300 border border-gray-700">
                            EP {{ $episodeNumber }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- Fecha de creación --}}
            <div class="border-t border-gray-800 px-6 md:px-8 py-4 flex items-center justify-between text-xs text-gray-500">
                <span>
                    ID: #{{ $character['id'] }}
                </span>
                <span>
                    Creado: {{ \Carbon\Carbon::parse($character['created'])->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>

@endsection
