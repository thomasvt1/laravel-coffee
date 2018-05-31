<?php use App\Http\Controllers\DashController;?>
@extends('layouts.app')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Change preference</h4>
                        <p class="card-category">Here it is possible to change your preference</p>
                    </div>
                    <div class="card-body ">
                           
                        {{Form::open(['route' => 'updateCup'])}}
                          
                        {{ Form::select('location', $machines->pluck('location', 'id'), null, ['hidden', 'class' => 'form-control','placeholder' => 'Pick a location']) }}
                        {{ Form::select('cup', $user_cups->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a cup']) }}
                        {{ Form::select('drink', $drinks->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a drink']) }}
                        {{ Form::select('startTime', $time, null, ['required', 'class' => 'form-control','placeholder' => 'Pick a start time']) }}
                        {{ Form::select('EndTime', $time, null, ['required', 'class' => 'form-control','placeholder' => 'Pick a end time']) }}

                        
                        <p class="card-category">Choose your strength:</p>
                        {{ Form::input('range', 'strength') }}

                        <br>
                        {{Form::submit('Submit')}}
                        <br>
                        {{Session::get('message')}}
                        {{ Form::close() }}
                        

                        
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Your preferences</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body ">
                        {{Form::open(['route' => 'deletePrefCup'])}}
                        @foreach ($preferences as $preference)   
                            <!--<p>{{ $preference}}</p>-->
                           
                             Cup: {{$cups->firstWhere('id', $preference->cup_id)->name}} -- preference drink: {{$drinks->firstWhere('id', $preference->drink_id)->name}}  --  strength: {{(json_decode($preference->data,true))['strength']}} <br><br> 
                        @endforeach
                        <br>
                        {{Form::submit('Delete')}}
                        <br>
                        {{Session::get('message')}}
                        {{ Form::close() }}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection