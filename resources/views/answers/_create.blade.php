<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>Your Answer</h2>
                </div>
                <hr>
                <form action="{{route('question.answer.store', $question)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>