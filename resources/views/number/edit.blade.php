@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
            <h3>    <div class="card-header">{{ __('Edytuj liczbę dni urlopu wypoczynkowego') }}</div> </h3>
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
<form method="post" action = "{{action('NumberController@update', $id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />



<div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Użytkownik:') }}</label>

                            <div class="col-md-6">
                         
<input type = "text" name="user_id" class="form-control" value="{{$number->user->surname}} {{$number->user->name}}" disabled  />

                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="liczba" class="col-md-4 col-form-label text-md-right">{{ __('Liczba dni urlopu wypoczynkowego do wykorzystania:') }}</label>

                            <div class="col-md-6">
                         
<input type = "number" step="0.5" name="liczba" class="form-control" value="{{$number->liczba}}" placeholder = "Uzupełnij liczbę dni do wykorzystania" />

                                @error('liczba')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
<input type="hidden" class="form-control" name="user_id2"  value="{{Auth::user()->id}}"/>


                  
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
