<!-- resources/views/admin/dashboard.blade.php -->
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

                        {{ __('Admin logged in!') }}

                        <div class="mt-4">
                            <h5>{{ __('Statistics') }}</h5>
                            <p>{{ __('Total Users: ') }}{{ $userCount }}</p>
                            <p>{{ __('Articles Published This Month: ') }}{{ $articleCount }}</p>
                        </div>

                            <div class="mt-4">
                                <h5>{{ __('Recent Articles') }}</h5>
                                @if($recentArticles->isEmpty())
                                    <p>{{ __('No recent articles.') }}</p>
                                @else
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Author') }}</th>
                                            <th>{{ __('Excerpt') }}</th>
                                            <th>{{ __('Published At') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recentArticles as $article)
                                            <tr>
                                                <td>{{ $article->article_title }}</td>
                                                <td>{{ $article->user->user_name }}</td>
                                                <td>{{ Str::limit($article->article_content, 50) }}</td>
                                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-info">{{ __('View') }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
