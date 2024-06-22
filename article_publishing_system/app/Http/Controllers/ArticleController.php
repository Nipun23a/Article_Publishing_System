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

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Authorize the update action
        $this->authorize('update', $article);
        $request->validate([
            'article_title' => 'required|string|max:255',
            'article_content' => 'required|string',
        ]);
        $article->update([
            'article_title' => $request->input('article_title'),
            'article_content' => $request->input('article_content'),
        ]);

        // Redirect to articles index with a success message
        return redirect()->route('articles.index')->with('status', 'Article updated successfully.');
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('status', 'Article deleted successfully.');
    }
    public function adminIndex()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }
}
