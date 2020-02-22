@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Repos list</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($repos) && $repos->count())
                            <table class="table table-hover table-bordered table-dark table-striped">
                                <thead>
                                <tr>
                                    <th>Owner name</th>
                                    <th>Avatar</th>
                                    <th>Repo name</th>
                                    <th>Repo updated at</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($repos as $repo)
                                <tr>
                                    <td>{{ $repo->owner->name }}</td>
                                    <td width="50">
                                        <img src="{{ $repo->owner->avatar }}" alt="{{ $repo->owner->name }}" class="w-100 rounded-circle">
                                    </td>
                                    <td>{{ $repo->name }}</td>
                                    <td>{{ $repo->updated_at }}</td>
                                    <td>
                                        <a href="{{ $repo->link }}" target="_blank" class="btn btn-info btn-sm">Go to repo</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{ $repos->links() }}
                        @else
                            <h2>Sorry! No repos today :)</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
