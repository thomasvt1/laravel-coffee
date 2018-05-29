<?php use App\Http\Controllers\CustomizeController;?>
@extends('layouts.app')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Name mug</h4>
                        <p class="card-category">Change the name of your mug</p>
                    </div>
                    
                    <div class="card-body ">
                        {{Form::open(['route' => 'updateName'])}}
                          
                        {{ Form::select('cup', $user_cups->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a cup']) }}
                        <br>
                        {{ Form::input('text', 'newname') }}
                        <br><br>
                        {{Form::submit('Submit')}}
                        <br>
                        {{Session::get('message')}}
                        {{ Form::close() }}
                           
                    </div>
                </div>
            </div>
            
            @foreach ($preferences as $preference)
            
            <div class="col-md-2">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Mug: {{$cups->firstWhere('id', $preference->cup_id)->name}}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body ">
                        {{$drinks->firstWhere('id', $preference->drink_id)->name}}
                    </div>
                </div>
            </div>
            
            @endforeach
            
        </div>
    </div>
@endsection
