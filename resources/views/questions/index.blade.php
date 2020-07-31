@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{ __('All Questions') }}</h2>
                        <div class="ml-auto">
                            <a href="{{route('question.create')}}">Ask Question</a>
                        </div>
    
                    </div>
                    
                </div>

                <div class="card-body">
                    @include('layouts._messages')

                   @foreach ($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="views">
                                {{$question->views}} {{ __('view') }}
                            </div>
                            <div class="status {{$question->status}}">
                                <strong>{{$question->answers}}</strong> {{ __('answers') }}
                            </div>
                            <div class="votes">
                               <strong> {{$question->votes}}</strong> {{ __('votes') }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                <div class="ml-auto">
                                    @if (Auth::user()->can('edit-question', $question))
                                        <a href="{{route('question.edit', $question)}}" class="btn btn-sm btn-outline-info">Edit</a> 
                                    @endif
                                    @if (Auth::user()->can('delete-question', $question))
                                        <form class="form-delete" action="{{route('question.destroy', $question)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>                                        
                                    @endif
                                </div>
                            </div>
                            <p class="lead">
                                Asked By
                                    <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">{{$question->created_date}}</small>
                            </p>
                            {{$question->body}}
                        </div>
                    </div>
                   @endforeach
                   <div class="text-center">
                        {{$questions->links()}}
                   </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
