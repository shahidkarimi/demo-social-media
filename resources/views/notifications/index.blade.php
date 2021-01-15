@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        @include('layouts.sidebar')
      </div>
      <div class="col-md-9">
          <h1>notifications</h1>
            <ul>
                @foreach (\Auth::user()->notifications as $item)
                    <li>{{$item->created_at}} {{$item->data['message']}}</li>
                @endforeach
            </ul>
      </div>
    </div>
  </div>
@endsection