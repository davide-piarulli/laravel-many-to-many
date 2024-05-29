@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="card m-5">
      <img class="card-img-top img-fluid" src="{{ asset('storage/' . $project->img) }}" alt="{{ $project->title }}"
        onerror="this.src='/img/noimg.jpg'">
      <div class="card-body">
        <h5><b>Titolo progetto:</b> {{ $project->title }}</h5>
        <h5><b>Tipo:</b> {{ $project->type->name }}</h5>
        <h5><b>Tecnologia:</b>
          <div>
            @forelse ($project->technologies as $technology)
              {{-- <a href="{{ route('admin.technologies.show', $technology) }}"> --}}
              <span class="badge text-bg-primary">{{ $technology->name }}</span>
              {{-- </a> --}}
            @empty
              <span>Nessuna tecnologia</span>
            @endforelse
          </div>
        </h5>


        {{-- Actions Edit e Delete --}}
        <div class="icons d-flex ">

          <button class="btn btn-warning me-3 " onclick="submitForm({{ $project->id }})">
            <i class="fa-solid fa-pencil"></i>
          </button>

          <form action="{{ route('admin.projects.destroy', $project) }}" method="post"
            onsubmit="return confirm('Sei sicuro di voler eliminare il progetto?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
