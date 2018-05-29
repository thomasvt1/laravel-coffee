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

                        <br>
                        {{Form::submit('Submit')}}
                        <br>
                        {{Session::get('message')}}
                        {{ Form::close() }}
                           
                    </div>
                </div>
            </div>
            <div class="col-md-2">
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
