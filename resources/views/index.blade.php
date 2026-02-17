@extends('layouts.app')

@section('title', 'Personajes de Rick y Morty — Wiki-Rick')

@section('content')

    {{-- Hero --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-portal-400 via-portal-300 to-rick-400 bg-clip-text text-transparent">
            Personajes de Rick y Morty
        </h1>
        <p class="mt-3 text-gray-400 text-lg">Explora el multiverso, un personaje a la vez.</p>
    </div>

    @if(count($characters) === 0)
        <div class="text-center py-20">
            <p class="text-2xl text-gray-500">😵 No se pudieron cargar los personajes. Inténtalo de nuevo más tarde.</p>
        </div>
    @else

        {{-- Grid de personajes --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($characters as $character)
                <div class="group bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 hover:border-portal-600/50 transition-all duration-300 hover:shadow-lg hover:shadow-portal-500/10 hover:-translate-y-1">
                    {{-- Imagen --}}
                    <div class="relative overflow-hidden">
                        <img
                            src="{{ $character['image'] }}"
                            alt="{{ $character['name'] }}"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                        {{-- Badge de estado --}}
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
                        <span class="absolute top-3 right-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold text-white {{ $statusColor }} shadow-lg">
                            <span class="w-2 h-2 rounded-full bg-white/40 animate-pulse"></span>
                            {{ $statusLabel }}
                        </span>
                    </div>

                    {{-- Info --}}
                    <div class="p-5">
                        <h2 class="text-lg font-bold text-white truncate" title="{{ $character['name'] }}">
                            {{ $character['name'] }}
                        </h2>
                        <p class="text-sm text-gray-400 mt-1">
                            <span class="text-portal-400">{{ $character['species'] }}</span>
                            @if(!empty($character['type']))
                                &middot; {{ $character['type'] }}
                            @endif
                        </p>

                        <a href="{{ route('characters.show', $character['id']) }}"
                           class="mt-4 inline-flex items-center justify-center w-full px-4 py-2.5 rounded-xl text-sm font-semibold
                                  bg-gradient-to-r from-portal-600 to-rick-600 hover:from-portal-500 hover:to-rick-500
                                  text-white shadow-md hover:shadow-portal-500/25 transition-all duration-300">
                            Ver detalles &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        @if($info)
            <div class="flex items-center justify-center gap-4 mt-10">
                @if($info['prev'])
                    <a href="?page={{ $currentPage - 1 }}"
                       class="px-6 py-2.5 rounded-xl bg-gray-800 hover:bg-gray-700 text-sm font-semibold text-gray-200 border border-gray-700 hover:border-portal-600 transition-all duration-200">
                        &larr; Anterior
                    </a>
                @endif

                <span class="text-sm text-gray-500">
                    Página {{ $currentPage }} de {{ $info['pages'] }}
                </span>

                @if($info['next'])
                    <a href="?page={{ $currentPage + 1 }}"
                       class="px-6 py-2.5 rounded-xl bg-gray-800 hover:bg-gray-700 text-sm font-semibold text-gray-200 border border-gray-700 hover:border-portal-600 transition-all duration-200">
                        Siguiente &rarr;
                    </a>
                @endif
            </div>
        @endif

    @endif

@endsection
