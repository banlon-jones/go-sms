@extends('layouts.app')

@section('content')
  
      <div class="row">
            <div class="col-md-12">
                  <div class="card bg-success">
                        <div class="card-body">
                              <div class="card-title">
                                          <h1 style="color:white"> {{$title}} </h1>
                              </div>
                        </div>
                        
                  </div>
                  <!--looping through the array -->
                  @if(count($services) > 0)
                        <ul class="list-group">
                        @foreach($services as $service)
                              <li class="list-group-item"><span class="fa fa-check"></span> {{$service}} </li>
                        @endforeach
                        </ul>
                  @endif
            </div>
      </div>

@endsection