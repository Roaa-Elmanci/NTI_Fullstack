@extends('layouts.app')

@section('title') Create Post @endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('posts.store')}}">
        @csrf  
        <div class="mb-3">
            <label  class="form-label">Title</label>
            <input name="title" class="form-control" type="text" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3" value="{{ old('description') }}"></textarea>
        </div>
        <div>
            <label class="form-label">Post creator</label>
            <select name="post_creator" class="form-contol">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>    
        </div>

        <button type="submit" class="btn btn-success mt-3">Submit</button>

    </form>
 
@endsection


