@extends('layouts.app')

@section('content')
    <div class="container my-5">
        @if (session('deleted'))
            <div class="alert alert-primary" role="alert">
                {{ session('deleted') }}
            </div>
        @endif
        <table class="table p-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Data D'inizio</th>
                    <th scope="col">Tipo Progetto</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td><span class="badge text-bg-info">{{ $project->type?->name }}</span>
                        </td>
                        <td><a href="{{ route('admin.projects.show', $project) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-eye"></i></a></td>
                        <td><a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary"><i
                                    class="fa-solid fa-pencil"></i></a></td>
                        <td>
                            <form class="d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                onsubmit="return confirm('Vuoi eliminare')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
