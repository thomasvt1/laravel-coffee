<?php use App\Http\Controllers\CustomizeController;?>
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
                           
                        {{Form::open(['route' => 'updateName'])}}
                          
                        {{ Form::select('cup', $user_cups->pluck('name', 'id'), null, ['required', 'class' => 'form-control','placeholder' => 'Pick a cup']) }}
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
                        Body
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
