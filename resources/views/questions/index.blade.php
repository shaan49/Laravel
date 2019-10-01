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

                            
                            <a class="btn btn-outline-secondary" href="{{route('questions.create')}}">Ask this Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._message')
                    
                   <?php foreach($questions as $question) :{}  ?>
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{$question->votes}}</strong>
                                {{str_plural('vote',$question->votes)}}
                            </div>

                            <div class="status {{$question->status}} " >
                                <strong>{{$question->answers_count}}</strong>
                                {{str_plural('answer',$question->answers_count)}}
                            </div>

                            <div class="views">
                                {{$question->views}}
                                {{str_plural('view',$question->views)}}
                            </div>
                        </div>
                        
                    <div class="media-body">
                        <div class="d-flex align-items-center">
                            <h3 class="mt-0">
                            <a href="{{$question->url}}">

                            {{$question->title}}
                            </a>
                            </h3>
                            <div class="ml-auto">

                                  @can('update', $question)

                                <a class="btn btn-outline-primary btn-sm" href="{{route('questions.edit',$question->id)}}">Edit</a>
                               
                                    @endcan
                                @can('delete', $question)

                                <form class="form-delete" action="{{route('questions.destroy', $question->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                   
                                <button onclick="return confirm('are you sure')" type="submit" class="btn btn-outline-danger btn-sm">Delete</button>

                                </form>
                                @endcan
                            </div>

                        </div>
                     
                            <p class="lead">
                                Asked by <a href="{{$question->user->url}}">
                                    {{$question->user->name}}
                                </a>
                                <small class="text-muted">
                                    
                                    {{$question->create_date}}
                                </small>
                            </p>
                        

                        {{str_limit($question->body, 250)}}
                    </div>
                    </div>
                    <hr>

                    <?php endforeach; ?>
                    <div class="pagination justify-content-center">
                    {{$questions->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
