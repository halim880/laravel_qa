@csrf
    <div class="form-group">
        <label for="question-title">Question Title</label>
        <input type="text" name="title" class="form-control" value="{{old('title', $question->title)}}" id="question_title" required>
    </div>
    <div class="form-group">
        <label for="question-title">Explain Your Question</label>
    <textarea name="body" id="question_body" cols="30" rows="10" class="form-control" required>{{old('body', $question->body)}}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>