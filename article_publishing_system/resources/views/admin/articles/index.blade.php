@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('All Articles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($articles->isEmpty())
                            <p>{{ __('There are no articles yet.') }}</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Author') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->article_title }}</td>
                                        <td>{{ $article->user->user_name }}</td>
                                        <td>
                                            <a href="{{ route('articles.show', $article) }}" class="btn btn-info">{{ __('View') }}</a>

                                            @can('update', $article)
                                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                                            @endcan

                                            @can('delete', $article)
                                                <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                                </form>
                                            @endcan
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
