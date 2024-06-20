<!-- resources/views/articles/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Your Articles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">{{ __('Create New Article') }}</a>

                        @if ($articles->isEmpty())
                            <p>{{ __('You have no articles yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->article_title }}</td>
                                        <td>
                                            <a href="{{ route('articles.show', $article) }}" class="btn btn-info">{{ __('View') }}</a>
                                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
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
@endsection

