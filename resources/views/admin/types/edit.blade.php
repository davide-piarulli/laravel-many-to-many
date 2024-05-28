@extends('layouts.admin')
@section('content')
  <div class="container">
    <form action="{{ route('admin.types.update', $type) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="title" class="form-label">Nome Tipo (*)</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name"
              value="{{ old('name', $type->name) }}">
            @error('name')
              <small class="text-danger">
                {{ $message }}
              </small>
            @enderror
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Modifica</button>
      <button type="reset" class="btn btn-warning">Svuota</button>
    </form>
  </div>
@endsection
