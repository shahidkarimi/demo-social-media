@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        @include('layouts.sidebar')
      </div>
      <div class="col-md-9">
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <h3>{{$user->name}}</h3>
                    </div>
                    <div class="col-md-3">
                      @if($user->id != \Auth::user()->id)
                      <follow-button user-id="{{$user->id}}" />
                      @endif
                    </div>
                </div>
            </div>
        </div>

        <user-wall user-id="{{$user->id}}" />

      </div>
    </div>
  </div>
@endsection