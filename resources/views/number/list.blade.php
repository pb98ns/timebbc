@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pl.min.js"></script>
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  


	<script type="text/javascript" src="documentation-assets/jquery.timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="documentation-assets/jquery.timepicker.css" />
	<script type="text/javascript" src="documentation-assets/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="documentation-assets/bootstrap-datepicker.css" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

  @endsection


@section('content')

<script>
$(function() {
    
  $('.selectpicker').on('click', function(event) {
    event.stopPropagation();
});
</script>

  

<div class="container">
@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="row justify-content-center">
    <center>
            <h3>    <div class="card-header">{{ __('Urlop wypoczynkowy - liczba dni do wykorzystania') }}</div> </h3>
                 </center>
                <div class="card-body">
<form action="{{action('NumberController@store')}}" method="POST" role="form">
<input type="hidden" name="_token" value="{{csrf_token()}}" />


<input type="hidden" class="form-control" name="user_id2"  value="{{Auth::user()->id}}"/>



<div class="form-group col-md-6">
<input id="user_id" type="hidden" data-width="100%" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" >
<label for="user_id"><b>Użytkownik:</b></label>
<br>
@error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <select name="user_id" title="Wybierz użytkownika" class="selectpicker" data-live-search="true" data-width="100%" id="user_id" required autocomplete="user_id"  >


@foreach ($user as $uzytkownik)
<option name="user_id" value="{{$uzytkownik->id}}">{{$uzytkownik->surname}} {{$uzytkownik->name}} </option>
@endforeach
</select>
</div>





<div class="form-group col-md-6">
<label for="task_id"><b>Liczba dni do wykorzystania:</b></label>
<br>

<input id="liczba" type="number" step="0.5" class="form-control @error('liczba') is-invalid @enderror" name="liczba" value="{{ old('liczba') }}" required autocomplete="liczba" autofocus>
                                
</div>
</div>


      
                               
              
<br>
                       


                        

                        <div class="form-group row mb-0">
                        
                        <input type="submit" value="Dodaj" class="btn btn-success" />
                       
                        </form>
                        </div>
                </div>
    </div>


  <br>

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __('Lista użytkowników z liczbą dni urlopu wypoczynkowego do wykorzystania') }}</div> </h3>
                 </center>
           
<table class="table" id="taskTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i imię</th>
      <th scope="col">Liczba dni urlopu wypoczynkowego do wykorzystania</th>
      <th scope="col">Ostatnia modyfikacja</th>
      <th scope="col"></th>
      <th scope="col"></th>



    </tr>
  </thead>
  <tbody>
  @foreach($number as $tasks) 

        
    <tr>
     
      <td class="table-success table-row"><b>{{ $loop->iteration }}. {{$tasks->user->surname}} {{$tasks->user->name}}</b></td>
      <td class="table-success table-row"><b>{{$tasks->liczba}}</b></td>
      <td class="table-success table-row"><b>{{ \Carbon\Carbon::parse($tasks->modification_date)->format('Y-m-d')}} {{ \Carbon\Carbon::parse($tasks->modification_time)->format('H:i:s')}} {{$tasks->otheruser->surname}} {{$tasks->otheruser->name}}</td>
      <td class="table-success table-row"><a href="{{action('NumberController@edit', $tasks->id) }}" class="btn btn-primary a-btn-slide-text" title="Edytuj">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>

    <td class="table-success table-row">
      <form method = "post" class="delete_from" action="{{action('NumberController@delete',$tasks->id )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="bi bi-trash"></span></button>
      </form>
      </td> 
    </tr>


    @endforeach
</tbody>
</table>
<script>
$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczony rekord?"))
{
return true;
}
else
{
return false;
}
});
});
</script>
</div>
</div>

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#taskTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba użytkowników: _TOTAL_",
      emptyTable: "Brak zdefiniowanych liczby dni urlopu wypoczynkowego",
      search: "Szukaj:" ,
    
      "paginate": {
      previous: "Poprzednia strona",
      next: "Następna strona"
    }
   
    },
    "oLanguage": {
      sLengthMenu: "Wyświetl _MENU_ rekordów",
    },
      "ordering": false,
      "pageLength": 50

      
    });
} );
</script>
@endpush

@endsection



