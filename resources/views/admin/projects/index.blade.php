@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<section>
    <div class="container">
        <h2>Projects</h2>
    </div>
    <div class="container">
        <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Add a new Project</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Slug</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></td>
                        <td>{{$project->type ? $project->type->name : ''}}</td>
                        <td>{{$project->description}}</td>
                        <td><a href="{{$project->link}}" target='_blank'>Github link</a></td>
                        <td>{{$project->slug}}</td>
                        <td>
                            <div class="col-auto ms-auto d-flex gap-2">
                                <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                                    @method('DELETE')
                                    @csrf

                                    <input type="submit" class="btn btn-danger" value="Trash">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection