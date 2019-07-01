@extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1>
        <p> Laravel from scratch from the international university of youtube </p>
        <h1 class="btn btn-primary"> Control structures</h1>
        <h3> conditional statements</h3>
        <p>
                @if(empty($title))
                        the title is empty
                
                @else 
                        the title is {{$title}}
                
                @endif
        </p>
@endsection
