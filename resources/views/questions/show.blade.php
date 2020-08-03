@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{$question->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{route('question.index')}}">Goto Questions</a>
                            </div>        
                        </div>
                    </div>
                    <hr>
    
                    <div class="media">
                        <div class="d-flex flex-column align-items-center vote-controls mr-2">
                            <a href="" title="This is a useful question" 
                                onclick="event.preventDefault(); document.getElementById('up_vote-question-{{$question->id}}').submit()"
                                class="vote-up {{Auth::guest() ? 'off':''}}">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">{{$question->votes_count}}</span>
                            <a href="" title="This is not useful" class="vote-down {{Auth::guest() ? 'off':''}}"
                                onclick="event.preventDefault(); document.getElementById('down_vote-question-{{$question->id}}').submit()"
                            >
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <a href="" title="Click to mark as a favorite question" 
                                class="d-flex align-items-center favorite {{Auth::guest() ? 'off':($question->is_favorited ? 'favorited':'')}}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{$question->id}}').submit()"
                                >
                                <i class="fa fa-star fa-3x"></i>
                                <form 
                                    action="/question/vote/{{$question->id}}" 
                                    id="up_vote-question-{{$question->id}}" 
                                    method="post"
                                    style="display:none;">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="vote" value="1">
                                </form>
                                <form 
                                    action="/question/vote/{{$question->id}}" 
                                    id="down_vote-question-{{$question->id}}" 
                                    method="post"
                                    style="display:none;">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                <form 
                                    action="/question/favorites/{{$question->id}}" 
                                    id="favorite-question-{{$question->id}}" 
                                    method="post"
                                    style="display:none;">
                                    @csrf
                                    @if ($question->is_favorited)
                                        @method("DELETE");
                                    @else
                                        @method('POST')
                                    @endif
                                </form>
                            </a>
                            <span class="favorite-count">{{$question->favorites_count}}</span>
                        </div>
                        <div class="media-body">
                            {!! $question->body !!}
                            <div class="float-right mt-3">
                                <span class="text-muted">Asked {{$question->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$question->user->url}}" class="pr-2">
                                        <img src="{{$question->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('answers._index', [
        'answers'=> $question->answers,
        'answersCount'=> $question->answers_count,
    ])
    @include('answers._create')
</div>
@endsection
