@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <!-- Detail Berita -->
    <div class="flex flex-col px-4 lg:px-14 mt-10">
        <div class="font-bold text-xl lg:text-2xl mb-6 text-center lg:text-left">
            <p>{{ $news->title }}</p>
        </div>
        <div class="flex flex-col lg:flex-row w-full gap-10">
            <!-- Berita Utama -->
            <div class="lg:w-8/12">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="MotoGP"
                    class="w-full max-h-96 rounded-xl object-cover">

                <article class="mt-5">
                    {!! $news->content !!}
                </article>
            </div>
            <!-- Berita Terbaru -->
            <div class="lg:w-4/12 flex flex-col gap-10">
                <div class="sticky top-24 z-40">
                    <p class="font-bold mb-8 text-xl lg:text-2xl">Berita Terbaru Lainnya</p>
                    <!-- Berita Card -->
                    <div class=" gap-5 flex flex-col">
                        @foreach ($newests as $new)
                            <a href="{{ route('news.show', $new->slug) }}">
                                <div class="flex gap-3 border border-slate-300 hover:border-primary p-3 rounded-xl">
                                    <div
                                        class="bg-primary text-white rounded-full w-fit px-5 py-1 ml-2 mt-2 font-normal text-xs absolute">
                                        {{ $new->newsCategory->title }}
                                    </div>
                                    <div class="flex gap-3 flex-col lg:flex-row">
                                        <img src="{{ asset('storage/' . $new->thumbnail) }}" alt=""
                                            class="max-h-36 rounded-xl object-cover" style="width: 200px;">
                                        <div class="">
                                            <p class="font-bold text-sm lg:text-base">{{ \Str::limit($new->title, 40) }}</p>
                                            <p class="text-slate-400 mt-2 text-sm lg:text-xs">
                                                {!! \Str::limit($new->content, 30) !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
