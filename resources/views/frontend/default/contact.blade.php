@extends('frontend.layout')
@section('title','Anasayfa Başlığı')
@section('content')

<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Bize Ulaşın</h1>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <h3>İletişim Formu</h3>
            <hr>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session()->has('success'))
            <div class="alert alert-success">
                <p>{{session('success')}}</p>
            </div>
            @endif

            <form method="POST">
                @csrf
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Ad Soyad:</label>
                        <input type="text" class="form-control" name="name" placeholder="Ad Soyad" required data-validation-required-message="Lütfen Adınızı Soy Adınızı Girin">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Telefon Numarası:</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Telefon Numaranız" required data-validation-required-message="Please enter your phone number.">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Mail Adresiniz:</label>
                        <input type="email" class="form-control" name="email" placeholder="Mail Adresnizi Giriniz" required data-validation-required-message="Please enter your email address.">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Mesaj:</label>
                        <textarea rows="10" cols="100" class="form-control" name="message" placeholder="" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                    </div>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-primary">Mesajı Gönder</button>
            </form>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
            <h3>Adres Detayları</h3>
            <p>
                {{ $adres }}
                <br>
                {{ $ilce }} / {{ $il }}
                <br>
                {{$phone_gsm}}
                <br>
                {{$phone_sabit}}
                <br>
                {{$mail}}

            </p>

        </div>
    </div>
</div>

@endsection
@section('css') @endsection
@section('js') @endsection