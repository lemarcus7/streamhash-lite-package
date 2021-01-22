@extends('layouts.user')

@section('styles')

<style type="text/css">

.navbar-form .btn { 

padding: 8px 10px;

}

h4 {

	text-transform: capitalize;
}

</style>

@endsection

@section('content')

<div class="video-full-box">

<h4>{{$model->heading}}</h4>


<?= $model->description; ?>

</div>

@endsection