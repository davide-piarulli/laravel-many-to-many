@extends('layouts.admin')
@section('content')
  <div class="container">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST">
      @csrf
      @method('PUT')
      <h1>Modifica progetto: {{ $project->title }}</h1>
      <div class="row">
        <div class="col mb-3">

          <label for="title" class="form-label">Nome Progetto (*)</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $project->title) }}">
          @error('title')
            <small class="text-danger">
              {{ $message }}
            </small>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">

          <label for="title" class="form-label">Immagine</label>

        </div>
      </div>
      <div class="row">
        <div class="col mb-3">

          <label for="link" class="form-label">Link</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="link" name="link"
            value="{{ old('link', $project->link) }}">
          @error('link')
            <small class="text-danger">
              {{ $message }}
            </small>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3">

            <label class="form-label">Tipo: </label>
            <select name="type_id" class="form-select " aria-label="Default select example">

              <option value="">Seleziona un tipo</option>
              @foreach ($types as $type)
                <option value="{{ $type->id }}" @if (old('type_id', $project?->type->id) == $type->id) selected @endif>
                  {{ $type->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">

          <label for="title" class="form-label">Tecnologia</label>
          <div class="btn-group btn-group-sm" role="group">
            @foreach ($technologies as $technology)
              <input name="technologies[]" id="technology_{{ $technology->id }}" class="btn-check" autocomplete="off"
                type="checkbox" value="{{ $technology->id }}" @if (
                    ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                        (!$errors->any() && $project?->technologies->contains($technology))) checked @endif>
              <label class="btn btn-outline-primary"
                for="technology_{{ $technology->id }}">{{ $technology->name }}</label>
            @endforeach

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">

          <label for="description" class="form-label">Descrizione</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
            name="description" value="{{ old('description', $project->description) }}">
          @error('description')
            <small class="text-danger">
              {{ $message }}
            </small>
          @enderror
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Modifica</button>
      <button type="reset" class="btn btn-warning">Svuota</button>
    </form>
  </div>
@endsection
