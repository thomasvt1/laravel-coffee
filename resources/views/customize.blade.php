<?php use App\Http\Controllers\CustomizeController;?>
@extends('layouts.app')

@section('content')



    <div class="container-fluid">
    
        @if(Session::has('warning'))
            <div class="alert alert-warning">
                {{Session::get('warning')}}
            </div>
        @elseif(Session::has('success'))
             <div class="alert alert-success">
             {{Session::get('success')}}
            </div>
        @endif
    
        <div class="row">
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Name mug</h4>
                        <p class="card-category">Change the name of your mug</p>
                    </div>
                    
                    <div class="card-body ">
                        {{Form::open(['route' => 'updateName'])}}
                          
                        {{ Form::select('cup', $user_cups->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a cup']) }}
                        <br>
                        Name<br>
                        {{ Form::input('text', 'newname') }}
                        <br><br>
                        {{Form::submit('Submit')}}
                        <br>
                        {{Session::get('message')}}
                        {{ Form::close() }}
                           
                    </div>
                </div>
            </div>
            
            <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Add mug</h4>
                        <p class="card-category">Add a mug to your account</p>
                    </div>
                    
                    <div class="card-body ">
                        {{Form::open(['route' => 'addCup'])}}
                          
                        Name
                        {{ Form::input('text', 'cupname') }}
                        <br>
                        UID<br>
                        {{ Form::input('text', 'newuid') }}
                        <br><br>
                        {{Form::submit('Submit')}}
                        <br>
                        {{Session::get('message')}}
                        {{ Form::close() }}
                           
                    </div>
                </div>
            </div>
            
            @foreach ($user_cups as $cup)
            
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{$cup->name}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body ">
                        Cup content TODO
                    </div>
                </div>
            </div>
            
            @endforeach
            
        </div>
    </div>
@endsection
