@extends('layouts.app')

@section('title', 'Semua Berita | Pberita')

@section('content')
<div class="container mx-auto px-4 lg:px-14 mt-8 mb-10">
    <!-- Header dan Filter -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
        <div>
            <h1 class="font-bold text-3xl text-gray-800 mb-2">Semua Berita</h1>
            <p class="text-gray-600">Temukan berita terkini dari berbagai kategori</p>
        </div>
        
        <!-- Filter dan Search -->
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <!-- Filter Kategori -->
            <form method="GET" action="{{ route('news.all') }}" class="flex gap-2">
                <select name="category" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="search" value="{{ request('search') }}">
            </form>
            
            <!-- Search -->
            <form method="GET" action="{{ route('news.all') }}" class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari berita..." 
                       class="border border-gray-300 rounded-lg px-4 py-2 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary w-full sm:w-64">
                <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="hidden" name="category" value="{{ request('category') }}">
            </form>
        </div>
    </div>

    <!-- Info hasil pencarian/filter -->
    @if(request('search') || request('category'))
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-blue-700 font-medium">
                    Menampilkan {{ $news->total() }} berita
                    @if(request('search'))
                        untuk pencarian "<strong>{{ request('search') }}</strong>"
                    @endif
                    @if(request('category'))
                        dari kategori "<strong>{{ $categories->where('slug', request('category'))->first()->title ?? '' }}</strong>"
                    @endif
                </p>
            </div>
            @if(request('search') || request('category'))
                <div class="mt-2">
                    <a href="{{ route('news.all') }}" class="text-blue-600 hover:text-blue-800 text-sm underline">
                        Hapus filter dan tampilkan semua berita
                    </a>
                </div>
            @endif
        </div>
    @endif

    <!-- Grid Berita -->
    @if($news->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($news as $item)
                <article class="group">
                    <a href="{{ route('news.show', $item->slug) }}" class="block">
                        <div class="border border-gray-200 rounded-xl overflow-hidden hover:border-primary hover:shadow-lg transition-all duration-300 ease-in-out h-full flex flex-col">
                            <!-- Image -->
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->title }}"
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                
                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-primary text-white text-xs font-medium px-3 py-1 rounded-full">
                                        {{ $item->newsCategory->title ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-4 flex-1 flex flex-col">
                                <h3 class="font-bold text-base mb-2 line-clamp-2 group-hover:text-primary transition-colors duration-200">
                                    {{ $item->title }}
                                </h3>
                                
                                <!-- Excerpt -->
                                <div class="text-gray-600 text-sm mb-3 flex-1">
                                    <p class="line-clamp-3">
                                        {!! \Str::limit(strip_tags($item->content), 120) !!}
                                    </p>
                                </div>
                                
                                <!-- Meta Info -->
                                <div class="flex items-center justify-between text-xs text-gray-500 pt-2 border-t border-gray-100">
                                    <div class="flex items-center gap-2">
                                        @if($item->author && $item->author->avatar)
                                            <img src="{{ asset('storage/' . $item->author->avatar) }}" 
                                                 alt="{{ $item->author->name ?? 'Author' }}"
                                                 class="w-4 h-4 rounded-full">
                                        @else
                                            <div class="w-4 h-4 rounded-full bg-gray-300"></div>
                                        @endif
                                        <span>{{ $item->author->name ?? 'Admin' }}</span>
                                    </div>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $news->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada berita ditemukan</h3>
            <p class="text-gray-500 mb-4">
                @if(request('search'))
                    Tidak ada hasil untuk pencarian "{{ request('search') }}"
                @elseif(request('category'))
                    Tidak ada berita dalam kategori "{{ $categories->where('slug', request('category'))->first()->title ?? '' }}"
                @else
                    Belum ada berita yang tersedia
                @endif
            </p>
            <a href="{{ route('news.all') }}" class="inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors duration-200">
                Lihat Semua Berita
            </a>
        </div>
    @endif
</div>

<style>

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection