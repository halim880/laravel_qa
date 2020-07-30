@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{ __('Ask Question') }}</h2>
                        <div class="ml-auto">
                            <a href="{{route('question.index')}}">Back to Question</a>
                        </div>
    
                    </div>
                    
                </div>

                <div class="card-body">
                   <form action="{{route('question.store')}}" method="post" class="form">
                    @csrf
                        <div class="form-group">
                            <label for="question-title">Question Title</label>
                            <input type="text" name="title" class="form-control" id="question_title" required>
                        </div>
                        <div class="form-group">
                            <label for="question-title">Explain Your Question</label>
                            <textarea name="body" id="question_body" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                   
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
