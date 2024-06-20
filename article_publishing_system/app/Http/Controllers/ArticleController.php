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
        ]);

        Article::create([
            'article_title' => $request->article_title,
            'article_content' => $request->article_content,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('status', 'Article created successfully.');
    }

    public function show(Article $article): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view', $article);
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $article);

        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required|string',
        ]);

        $article->update($request->all());

        return redirect()->route('articles.index')->with('status', 'Article updated successfully.');
    }

    public function destroy(Article $article): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $article);
        $article->delete();

        return redirect()->route('articles.index')->with('status', 'Article deleted successfully.');
    }
}
