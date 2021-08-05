@extends('layout.master')

@section('title') Pago PSE @stop

@section('content')
   <div class="container contact-form">

        <div class="contact-image">
            <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
        </div>
        <form method="post" action="{{route('app.create-pse-session')}}">
            @csrf
            <input type="hidden" value="{{$idForm}}" name="idForm">
            <h2>Confirmación de pago</h2>
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
                        <label id="person">Tipo persona</label>
                        <select name="person" id="person" required>
                            <option value="0">Persona</option>
                            <option value="1">Empresa</option>
                        </select><br>

                    </div>
                    <div >
                        <label id="documentType">Tipo de documento</label>
                        <select name="documentType" id="documentType" required>
                            <option value="CC">Cedula de Ciudadania</option>
                            <option value="CE">Cedula Extranjera</option>
                            <option value="PPN">Pasaporte</option>
                            <option value="TI">Tarjeta de Identida</option>

                        </select><br>

                    </div>

                    <div>
                        <label id="document">Numero de documento</label>
                        <input name="document" type="text" id="document" required value="{{old('document')}}"><br>
                    </div>

                    <div>
                        <label id="name">{{trans('payment.name')}}</label>
                        <input name="name" type="text" id="name" required><br>
                    </div>

                    <div>
                        <label id="surname">Apellidos</label>
                        <input name="surname" type="text" id="surname" required><br>
                    </div>

                    <div>
                        <label id="email">Direccion Email</label>
                        <input name="email" type="email" id="email" required><br>
                    </div>

                    <div >
                        <label id="bank">Elija el banco</label>
                        <select name="bank" id="bank" required>
                            @foreach($banks as $bank)
                                <option value="{{$bank->bankCode}}">{{$bank->bankName}}</option>
                            @endforeach
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
                <td>Estado de la transacción</td>
                <td>{{$data->transactionState}}</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Referencia</td>
                <td>{{$data->reference}}</td>
            </tr>
            <tr>
                <td>Mensaje respuesta</td>
                <td>{{$data->responseReasonText}}</td>
            </tr>

            </tbody>
        </table>
    </div>


    @endif
@stop