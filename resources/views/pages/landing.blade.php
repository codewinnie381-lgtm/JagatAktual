@extends('layouts.app')

@section('title', 'Pberita | Baca Berita Online')

@section('content')
    <!-- swiper -->
<section
    style="
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: #ffffff;
        padding: 4.5rem 1rem;
        text-align: center;
    "
>
    <div
        style="
            max-width: 1200px;
            margin: 0 auto;
        "
    >
        <h1
            style="
                font-size: 2.75rem;
                font-weight: 700;
                margin-bottom: 1rem;
            "
        >
            Selamat Datang di Jagat Aktual
        </h1>

        <p
            style="
                font-size: 1.125rem;
                opacity: 0.95;
                max-width: 600px;
                margin: 0 auto;
                line-height: 1.6;
            "
        >
            Portal berita terpercaya dengan informasi terkini dari berbagai
            kategori
        </p>
    </div>
</section>

@if (isset($categories) && $categories->count())
<section
    style="
        background-color: #f8fafc;
        padding: 2.5rem 1rem;
    "
>
    <div
        style="
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        "
    >
        <h2
            style="
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1.5rem;
                color: #0f172a;
            "
        >
            Kategori Berita
        </h2>

        <div
            style="
                display: flex;
                justify-content: center;
                gap: 0.75rem;
                flex-wrap: wrap;
            "
        >
            @foreach ($categories as $category)
                <a
                    href="{{ route('category.show', $category->slug) }}"
                    style="
                        display: inline-flex;
                        align-items: center;
                        gap: 0.4rem;
                        padding: 0.6rem 1.25rem;
                        border-radius: 999px;
                        background-color: {{ $category->color ?? '#2563eb' }};
                        color: #ffffff;
                        text-decoration: none;
                        font-size: 0.875rem;
                        font-weight: 500;
                        transition: transform 0.2s ease, box-shadow 0.2s ease;
                        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
                    "
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 14px rgba(0,0,0,0.12)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.08)'"
                >
                    {{ $category->icon ?? '' }}
                    {{ $category->title }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

    <!-- Berita Unggulan -->
    <div class="flex flex-col px-14 mt-10 ">
        <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Berita Unggulan</p>
                <p>Untuk Kamu</p>
            </div>    
        <a href="{{ route('news.all') }}"
                class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit"style="background-color: #2563eb;">
                Lihat Semua
            </a>
        </div>
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
            @foreach ($featureds as $featured)
                <a href="{{ route('news.show', $featured->slug) }}">
                    <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
                        style="height: 100%">
                        <div
                            class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                            {{ $featured->newsCategory->title }}
                        </div>
                        <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt=""
                            class="w-full rounded-xl mb-3" style="height: 150px; object-fit: cover;">
                        <p class="font-bold text-base mb-1">{{ $featured->title }}</p>
                        <p class="text-slate-400">{{ \Carbon\Carbon::parse($featured->created_at)->format('d F Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Berita Terbaru -->
  <div class="flex flex-col px-14 mt-10">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Terbaru</p>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-5 lg:grid-cols-4">
        <!-- Berita Utama -->
@php
    $headline = $news->first();
@endphp

@if ($headline)
    <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
        style="height: 100%;">
        <a href="{{ route('news.show', $headline->slug) }}">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
                {{ $headline->newsCategory->title }}
            </div>
            <img src="{{ asset('storage/'.$headline->thumbnail) }}" alt="" class="w-full rounded-xl mb-3">
            <p class="font-bold text-xl mt-1">
                {{ $headline->title }}
            </p>
            <p class="text-slate-400 text-base mt-1">
                {!! \Str::limit($headline->content, 100) !!}
            </p>
        </a>
    </div>
@else
    <div class="border border-dashed border-slate-300 p-6 rounded-xl text-center text-slate-400">
        Belum ada berita terbaru
    </div>
@endif

          <!-- Berita 1 -->
@foreach ($news->skip(1) as $new)
    <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
        style="height: 100%;">
        <a href="{{ route('news.show', $new->slug) }}">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
                {{ $new->newsCategory->title }}
            </div>
            <img src="{{ asset('storage/'.$new->thumbnail) }}" alt="" class="w-full rounded-xl mb-3">
            <p class="font-bold text-xl mt-1">{{ $new->title }}</p>
            <p class="text-slate-400 text-base mt-1">
                {!! \Str::limit($new->content, 100) !!}
            </p>
        </a>
    </div>
@endforeach

      </div>
    </div>


    <!-- Pilihan Author -->
    <div class="flex flex-col px-14 mt-10 mb-10">
        <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Pilihan Author</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
            @foreach ($news as $choice)
                <a href="{{ route('news.show', $choice->slug) }}">
                    <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
                        style="height: 100%;">
                        <div
                            class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                            {{ $choice->newsCategory->title }}
                        </div>
                        <img src="{{ asset('storage/' . $choice->thumbnail) }}" alt=""
                            class="w-full rounded-xl mb-3" style="height: 200px; object-fit: cover;">
                        <p class="font-bold text-base mb-1">
                            {{ $choice->title }}
                        </p>
                        <p class="text-slate-400">{{ \Carbon\Carbon::parse($choice->created_at)->format('d F Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    
@endsection
