<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::where('author_id', Auth::id())->get();
        return view('articles.index', compact('articles'));
    }
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('articles.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        Article::create([
            'article_title' => $request->article_title,
            'article_content' => $request->article_content,
            'is_published' => $request->is_published,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('status', 'Article created successfully.');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        if (!$article->is_published && $article->author_id !== Auth::id()) {
            abort(403);
        }
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);
        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        $article->update([
            'article_title' => $request->input('article_title'),
            'article_content' => $request->input('article_content'),
            'is_published' => $request->input('is_published'),
        ]);

        return redirect()->route('articles.index')->with('status', 'Article updated successfully.');
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();
        if(Auth::user()->userRole->role_name == "admin") {
            return redirect()->route('admin.articles.index')->with('status', 'Article deleted successfully.');
        }else{
            return redirect()->route('articles.index')->with('status', 'Article deleted successfully.');
        }
    }

    public function dashboard()
    {
        $articles = Article::where('is_published', true)
            ->where('author_id', '!=', Auth::id())
            ->get();
        return view('home', compact('articles'));
    }
    public function adminIndex()
    {
        $articles = Article::where('is_published', true)
            ->where('author_id', '!=', Auth::id())
            ->get();
        return view('admin.articles.index', compact('articles'));
    }

}
