@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
     <div class="w-full bg-[#F6F6F6] py-12 px-4 lg:px-14">
        <div class="max-w-6xl mx-auto text-center mb-10">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-800">Hasil untuk: <span class="text-hasil">"{{ $search }}"</span></h2>
        </div>

        @if($news->count())
            <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', $item->slug) }}">
                        <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out" style= "height:100%">
                            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
                                {{ $item->newsCategory->title }}
                            </div>
                            <img src="{{ asset('storage/' .$item->thumbnail) }}"alt=""
                            class="w-full rounded-xl mb-3" style="height: 250px; object-fit: cover;">
                            <p class="font-bold text-xl mt-1">{{ $item->title }}</p>
                            <p class="text-slate-400 text-base mt-1">
                            {!! \Str::limit($news[0]->content, 100) !!}
                            </p>
                            <p class="text-slate-400">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $news->withQueryString()->links() }}
            </div>
        @else
            <p>Tidak ada hasil yang ditemukan.</p>
        @endif
    </div>
@endsection
