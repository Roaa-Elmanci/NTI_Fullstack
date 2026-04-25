@extends('layouts.app')

@section('title') Edit Post @endsection

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
    
    <form method="POST" action="{{route('posts.update',$post->id)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label  class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ $post->title }}" type="text" >
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3">{{ $post->description }}</textarea>
        </div>
        <div>
            <label class="form-label">Post creator</label>
            <select name="post_creator" class="form-contol">
                @foreach ($users as $user)
                    <option @if($user->id == $post->user_id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>    
        </div>

        <button class="btn btn-primary mt-3">Update</button>

    </form>


@endsection