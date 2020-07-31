

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>Editing Answer for Question : {{$question->title}}</h2>
                        </div>
                        <hr>
                        <form action="{{route('question.answer.update', [$question, $answer])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="" cols="30" rows="10">{{$answer->body}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update answer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
