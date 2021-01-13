@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        <a href="#">Home</a>
      </div>
      <div class="col-md-9">
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <h3>{{$user->name}}</h3>
                    </div>
                    <div class="col-md-3">
                      <follow-button user-id="{{$user->id}}" />
                    </div>
                </div>
            </div>
        </div>

        <user-wall user-id="{{$user->id}}" />

      </div>
    </div>
  </div>
@endsection