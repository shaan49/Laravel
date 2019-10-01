@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    
                    <div class="d-flex align-item-center">
                        <h3>All Question</h3>
                        <div class="ml-auto">
                            
                            <a class="btn btn-outline-secondary" href="{{route('questions.index')}}">Back To All Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

        <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="post">


                        
                                @csrf

                            @method('PUT')

                         <div class="form-group">

                            <label for="question-body">
                                Update Your Question
                            </label>
                            <textarea rows="10" id="question-body" name="body" class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}">
                                
                                {{old('body', $answer->body)}}
                            </textarea>

                                @if ($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary btn-lg" type="submit">Update your answer</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
