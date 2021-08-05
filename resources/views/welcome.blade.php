@extends('layout.master')

@section('title') Pagos @stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h1>Seleccione metodo de pago</h1>
        </div>
        <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-3">
            <a href="{{route('app.pse')}}">
                <img class="img-box" style="width: 130px;" src="https://www.homecenter.com.co/static/landing/PSE/img/PSE.png" alt="pse"/>
            </a>
        </div>
        <div class="col-3">
            <a href="{{route('app.index')}}">
                <img class="img-box" style="width: 260px;margin-top: 44px;margin-left: -130px;"  src="https://webcheckout.net/wp-content/uploads/2017/12/Webcheckout-Logo-2x.png" alt="webcheckout">
            </a>
        </div>
        <div class="col-3"></div>
    </div>
</div>

@stop

