@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')

<div class="container mt-3">
    <form action="{{route('admin.projects.update', $project)}}" method="POST"> 
        @csrf
        @method('PUT')
    
        <div>
            <label class="form-label fs-5" for="title">Projet title</label>
            <input type="text" class="form-control" name='title' placeholder="Title" value="{{$project->title}}">
        </div>
        <div>
            <label class="form-label fs-5" for="description">Projet Description</label>
            <input type="text" class="form-control" name='description' placeholder="Description" value="{{$project->description}}">
        </div>
        {{-- <div>
            <label for="type_id" class="form-label">Select type</label>
            <select name="type_id" id="type_id" class="form-control">
                <option value="">-- Select Type --</option>
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id')) value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div> --}}
        <div>
            <label class="form-label fs-5" for="link">Projet Github Link</label>
            <input type="text" class="form-control" name='link' placeholder="Github Link" value="{{$project->link}}">
        </div>
        <input type="submit" value="Save Project" class="btn btn-primary m-3">
        
    
    </form>
</div>

@endsection