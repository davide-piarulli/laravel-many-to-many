@extends('layouts.admin')
@section('content')
  <div class="container">
    <div class="card" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5>Titolo progetto: {{ $project->title }}</h5>
        <h5>Tipo: {{ $project->type }}</h5>
        <h5>Tecnologia:
          @forelse ($project->technologies as $technology)
            <span class="badge text-bg-primary">{{ $technology->name }}</span>
          @empty
            <span>Nessuna tecnologia</span>
          @endforelse
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
