@extends('layouts.app')

@section('title', 'Project')

@section('content')

<main>
    <section class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <h2>{{$project->title}}</h2>
                </div>
                <div class="col-auto ms-auto d-flex gap-2">
                    <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                        @method('DELETE')
                        @csrf

                        <input type="submit" class="btn btn-danger" value="Trash">
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <p><strong>Description: </strong>{{$project->description}}</p>
            @if ($project->type)
                <p><strong>Type: </strong>{{$project->type ? $project->type->name : ''}}</p>
            @endif
            <p><strong>Github link: </strong>{{$project->link}}</p>
        </div>
    </section>
</main>

@endsection