<?php use App\Http\Controllers\DashController;?>
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
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Change preference</h4>
                        <p class="card-category">Here it is possible to change your preference</p>
                    </div>
                    <div class="card-body ">
                           
                        {{Form::open(['route' => 'updateCup'])}}
                          
                        {{ Form::select('location', $machines->pluck('location', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a location']) }}
                        {{ Form::select('cup', $user_cups->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a cup']) }}
                        {{ Form::select('drink', $drinks->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a drink']) }}
                        {{ Form::select('startTime', $time, null, ['class' => 'form-control','placeholder' => 'Pick a start time']) }}
                        {{ Form::select('endTime', $time, null, ['class' => 'form-control','placeholder' => 'Pick a end time']) }}
                        <br>
                        Choose the days you want this preference
                        <br>
                        @foreach ($days as $day)   
                            {{ Form::checkbox('checkbox' . $day) }}
                                {{$day}}
                            <br> 
                        @endforeach
                        <br>
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
                            {{ Form::checkbox('checkbox' . $preference->id) }}
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
           @foreach ($preferences as $preference)
            
            <div class="col-md-2">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{$cups->firstWhere('id', $preference->cup_id)->name}}</h4>
                        
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body ">
                        preference drink: {{$drinks->firstWhere('id', $preference->drink_id)->name}} <br>
                        strength: {{(json_decode($preference->data,true))['strength']}}
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
@endsection
