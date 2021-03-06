@extends('layout.master')

@section('title') Pago por Webcheckout @stop

@section('content')

    <div class="container contact-form">

        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
        </div>
        <form method="post" action="{{route('app.create-session')}}">
            @csrf
            <input type="hidden" value="{{$idForm}}" name="idForm">
            <h2>Confrimacion de pago</h2>
            <div class="row">
                <div class="col-md-6">

                    <div  >
                        <label id="amount">Valor a pagar</label>
                        <input name="amount" type="text" id="amount" required><br>
                    </div>

                    <div >
                        <label id="currency">Elija la moneda</label>
                        <select name="currency" id="currency" required>
                            <option value="USD">Dolar</option>
                            <option value="COP">Peso Colombiano</option>
                        </select><br>

                    </div>

                    <div >
                        <label id="description">Descripcion del producto</label>
                        <input name="description" type="text" id="description"><br>
                    </div>

                    <div >
                        <input type="submit" value="Pagar" class="btn btn-success">
                        <a href="{{route('home.index')}}" class="btn btn-danger">Regresar</a>
                    </div>

                </div>
            </div>
        </form>
    </div>

<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@if(!empty($data))

    <div class="container">
        <h4>Estado del pago</h4>
        <table class="table Estado-del-pago">
            <thead>
            <tr>
                <td>Estado de la transacci??n</td>
                <td>{{$data['status']['status']}}</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Referencia</td>
                <td>{{$data['request']['payment']['reference']}}</td>
            </tr>
            <tr>
                <td>Valor de transacci??n</td>
                <td>{{$data['request']['payment']['amount']['currency']}} $ {{number_format($data['request']['payment']['amount']['total'])}}</td>
            </tr>

            </tbody>
        </table>
    </div>


    @endif

@stop