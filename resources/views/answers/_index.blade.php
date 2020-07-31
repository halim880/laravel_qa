<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answersCount}} Answers</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column align-items-center vote-controls mr-2">
                            <a href="" title="This is a useful question" class="vote-up">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a href="" title="This is not useful" class="vote-down off">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                           @can('accept', $answer)
                            <a href="" title="Click to mark as best answer" class="d-flex align-items-center {{$answer->status}}"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit()"
                                >
                                <i class="fa fa-check fa-2x pr-2"></i>
                            </a>
                            <form 
                                action="{{route('answer.accept', $answer)}}" 
                                id="accept-answer-{{$answer->id}}" 
                                method="post"
                                style="display:none;">
                                @csrf
                            </form>
                            @else 
                                @if ($answer->is_best)
                                    <a href="" title="Click to mark as best answer" class="d-flex align-items-center {{$answer->status}}">
                                        <i class="fa fa-check fa-2x pr-2"></i>
                                    </a>
                                @endif                            
                           @endcan
                        </div>
                        <div class="media-body">
                            
                            {{$answer->body}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{route('question.answer.edit', [$question, $answer])}}" class="btn btn-sm btn-outline-info">Edit</a> 
                                        @endcan
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{route('question.answer.destroy', [$question, $answer])}}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>                                        
                                        @endcan
                                    </div>
                                </div>

                            </div>
                           
                            <div class="float-right mt-3">
                                <span class="text-muted">Answered {{$question->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$answer->user->url}}" class="pr-2">
                                        <img src="{{$answer->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                    </div>
                                </div>
                            </div>  
                        </div>
                                          
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>