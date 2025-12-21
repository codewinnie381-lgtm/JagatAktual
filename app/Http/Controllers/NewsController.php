<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();
        $newests = News::orderBy('created_at', 'desc')->get()->take(4);

        return view('pages.news.show', compact('news', 'newests'));
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->first();
        
      
        if (!$category) {
            abort(404, 'Kategori tidak ditemukan');
        }
        

        $news = News::with(['newsCategory', 'author'])
                    ->whereHas('newsCategory', function ($query) use ($category) {
                        $query->where('id', $category->id);
                    })
                    ->latest()
                    ->paginate(12);

        return view('pages.news.category', compact('category', 'news'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $news = News::where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('newsCategory', function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
                    ->latest()
                    ->paginate(10);

        return view('pages.news.search-results', compact('news', 'search'));
    }

    public function allNews(Request $request)
    {
        $query = News::with(['newsCategory', 'author']);
        

        if ($request->filled('category')) {
            $query->whereHas('newsCategory', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        

        $news = $query->latest()->paginate(12)->withQueryString();
        
      
        $categories = NewsCategory::orderBy('title')->get();
        
        return view('pages.news.all', compact('news', 'categories'));
    }
}