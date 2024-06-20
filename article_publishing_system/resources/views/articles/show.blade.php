<!-- resources/views/articles/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Article Details') }}</div>

                    <div class="card-body">
                        <h1>{{ $article->article_title }}</h1>
                        <p>{{ $article->article_content }}</p>

                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">{{ __('Edit') }}</a>

                        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

