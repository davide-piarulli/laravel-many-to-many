@extends('layouts.admin')
@section('content')
  <div class="container">
    <form action="{{ route('admin.technologies.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="title" class="form-label">Nome Tecnologia (*)</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
              value="{{ old('name') }}">
            @error('name')
              <small class="text-danger">
                {{ $message }}
              </small>
            @enderror
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary me-3">Aggiungi</button>
      <button type="reset" class="btn btn-warning">Svuota</button>
    </form>
  </div>
@endsection
