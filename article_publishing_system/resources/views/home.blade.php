@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>{{ __('Published Articles') }}</h2>
                        @if ($articles->isEmpty())
                            <p>{{ __('No published articles available.') }}</p>
                        @else
                            @foreach ($articles as $article)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $article->article_title }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">by {{ $article->user->name }}</h6>
                                        <p class="card-text">{{ Str::limit($article->article_content, 150) }}</p>
                                        <a href="{{ route('articles.show', $article->id) }}" class="card-link">{{ __('Read more') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
