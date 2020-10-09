@extends('layouts.main')
@section('content')
<div class="main-wrapper">
    @include('includes.sidemenu')
    <div id="mainLoader">
        <div class="fs-loading-content center-middle">
        <p class="fs-loading-icon"></p>
        <div class="item item-1"></div>
        <div class="item item-2"></div>
        <div class="item item-3"></div>
        <div class="item item-4"></div>
        <p></p>
        <p class="fs-loading-text"> Loading <span class="load-percentage"></span> </p>
        </div>
    </div>
    <canvas id="canvas"></canvas>
</div>
@endsection