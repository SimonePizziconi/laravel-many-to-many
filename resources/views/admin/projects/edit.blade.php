@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror " id="title" name="title"
                value="{{ old('title', $project->title) }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <label for="type" class="form-label">Tipo</label>
        <select name="type_id" id="type" class="form-select" aria-label="Default select example">
            <option selected>Scegli tipo di progetto</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}</option>
            @endforeach
        </select>
        <div class="mb-3">
            <label for="type" class="form-label d-block">Tecnologie</label>
            @foreach ($technologies as $technology)
                <input name="technologies[]" type="checkbox" class="btn-check" id="check-{{ $technology->id }}"
                    autocomplete="off" value="{{ $technology->id }}" {{-- validazione checked --}} @checked(
                        ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                            (!$errors->any() && $project->technologies->contains($technology->id)))>
                <label class="btn btn-primary" for="check-{{ $technology->id }}">{{ $technology->name }}</label>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="client" class="form-label">Cliente</label>
            <input type="text" class="form-control @error('client') is-invalid @enderror" id="client" name="client"
                value="{{ old('client', $project->client) }}">
            @error('client')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Data di inizio</label>
            <input type="text" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                name="start_date" value="{{ old('start_date', $project->start_date) }}">
            @error('start_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Data di fine</label>
            <input type="text" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                name="end_date" value="{{ old('end_date', $project->end_date) }}">
            @error('end_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{ old('image', $project->image) }}">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="project_url" class="form-label">Url progetto</label>
            <input type="text" class="form-control @error('project_url') is-invalid @enderror" id="project_url"
                name="project_url" value="{{ old('project_url', $project->project_url) }}">
            @error('project_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="10">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
