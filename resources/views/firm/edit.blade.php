@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
            <h3>    <div class="card-header">{{ __('Edytuj dane klienta') }}</div> </h3>
                 </center>
                <div class="card-body">
                @if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
@endif
<form method="post" action = "{{action('FirmController@update', $id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa:') }}</label>

                            <div class="col-md-6">
                         
<input type = "text" name="name" class="form-control" value="{{$firm->name}}" placeholder = "Uzupełnij nazwę klienta" />

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Numer w programie:') }}</label>

                            <div class="col-md-6">
                            <input type = "text" name="number" class="form-control" value="{{$firm->number}}" placeholder = "Uzupełnij numer klienta w programie" />

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
     


                        <div class="form-group row">
                            <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Adres:') }}</label>

                            <div class="col-md-6">
                            <input type = "text" name="place" class="form-control" value="{{$firm->place}}" placeholder = "Uzupełnij adres klienta" />

                                @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('Nip:') }}</label>

                            <div class="col-md-6">
                            <input type = "text" name="nip" class="form-control" value="{{$firm->nip}}" placeholder = "Uzupełnij numer Nip" />

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
<label for="status" class="col-md-4 col-form-label text-md-right"><b>{{ __('Status:') }}</b></label>
<div class="col-md-6">

@if($firm->status == 'Aktywny')
<input type="radio" name="status" value="Aktywny"  checked> Aktywny <br/>
<input type="radio" name="status" value="Nieaktywny"> Nieaktywny <br/>
@endif
@if($firm->status == 'Nieaktywny')
<input type="radio" name="status" value="Aktywny"> Aktywny <br/>
<input type="radio" name="status" value="Nieaktywny" checked> Nieaktywny <br/>
@endif


 @error('status')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="form-group row">
<label for="kpir" class="col-md-4 col-form-label text-md-right"><b>{{ __('KPiR:') }}</b></label>
<div class="col-md-6">
@if($firm->kpir == 'KPIR')
<input class="form-check-input" name="kpir" type="checkbox" value="KPIR" id="flexCheckDefault" checked/>
@else
<input class="form-check-input" name="kpir" type="checkbox" value="KPIR" id="flexCheckDefault" />

@endif
</div>
</div>       

<div class="form-group row">
<label for="kh" class="col-md-4 col-form-label text-md-right"><b>{{ __('Księgi Handlowe:') }}</b></label>
<div class="col-md-6">
@if($firm->kh == 'KH')
<input class="form-check-input" name="kh" type="checkbox" value="KH" id="flexCheckDefault2" checked/>
@else
<input class="form-check-input" name="kh" type="checkbox" value="KH" id="flexCheckDefault2" />

@endif
</div>
</div>   

<div class="form-group row">
<label for="placezus" class="col-md-4 col-form-label text-md-right"><b>{{ __('Płace:') }}</b></label>
<div class="col-md-6">
@if($firm->placezus == 'PLACE')
<input class="form-check-input" name="placezus" type="checkbox" value="PLACE" id="flexCheckDefault3" checked/>
@else
<input class="form-check-input" name="placezus" type="checkbox" value="PLACE" id="flexCheckDefault3" />

@endif
</div>
</div> 

<br>
                        <div class="form-group row mb-0">
                        <div class = "form-group">
                        <center>
<input type = "submit" class="btn btn-primary" value="Zapisz zmiany" />
<a href="{{url()->previous()}}" type="button" class="btn btn-danger">Anuluj</a>
</center>
</div>

</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection