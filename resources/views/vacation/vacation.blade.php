@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

@endsection
@section('content')
@if(is_null($today2))
<?php
$today2 = date('Y-01-01');
?>
@endif

@if(is_null($today3))
<?php
$today3 = date('Y-12-31');
?>
@endif


@if(is_null($today))
<?php
$today = date('Y-m-d');
?>
@endif



<div class="container ">

    <div class="row justify-content-center">
      
  <center>
 <h3>    <div class="card-header">{{ __('Raport urlopowy z dnia') }}  {{$today}} ({{ \Carbon\Carbon::parse($today)->translatedFormat('l') }})</div> </h3>
 </center>

<div class="col-mx-auto ">

<form action="{{action('VacationController@searchday')}}" method="POST" role="form">
@csrf

    <div class="form-row d-flex flex-grow-1 justify-content-center align-items-center">

        <div class="form-group col-md-3 ">
            <label for="inputCity" class="form-row d-flex flex-grow-1 justify-content-center align-items-center">Data</label>
<center>
            <input type="date" class="form-control"name="start_date" id="start_date">
</center>       
 <br>


 
 
            <div class="form-group">
 <center>
 <button type = "submit" class="btn btn-primary">Szukaj</button>

 </center>
 </div>

  
</form>
</div>
</div>




  
      
         

<table class="table" id="myTable">



  <thead>

    <tr>

    <th scope="col" class="table-secondary">Użytkownik</th>
  <th scope="col" class="table-secondary">Data</th>
    <th scope="col" class="table-secondary">Typ urlopu</th>
    <th scope="col" class="table-secondary">Wymiar urlopu</th>

      
     

    </tr>
  </thead>
  <tbody>

  @foreach($vacations as $projects) 
  @if($projects->type_vacation === "UW")
    <tr>

    <td class="table-success">{{$projects->user->surname}} {{$projects->user->name}}</td>  
        <td class="table-success">{{$projects->vacation_date}}</td>  



<td class="table-success">Urlop wypoczynkowy</td>  
<td class="table-success">{{$projects->size}} </td>  
</tr>
@endif
@endforeach

@foreach($vacations as $projects) 
@if($projects->type_vacation === "CH")
    <tr>

    <td class="table-danger">{{$projects->user->surname}} {{$projects->user->name}}</td>  
    <td class="table-danger">{{$projects->vacation_date}}</td>  


<td class="table-danger">Urlop chorobowy</td>  
<td class="table-danger">{{$projects->size}} </td> 
</tr>
@endif
    @endforeach
   
</table>



<br>


</div>
</div>








<div class="container">
    <div class="row justify-content-center">
      
         
    <center>
            <h3>    <div class="card-header">{{ __('Liczba dni wykorzystanego urlopu') }} </div> </h3>
                 </center>


<div class="form-group col-md-6"  style="margin-top: 30px;">
    <div class="row justify-content-center">
    <div class="form-row">
     <form action="{{action('VacationController@searchperiod')}}" method="POST" role="form">
     @csrf
<div class="form-group col-md-4">
    <label for="inputCity">Data początkowa:</label>
    <input type="date" class="form-control" name="start_date2" id="start_date2" >
</div>

<div class="form-group col-md-4">
    <label for="inputZip">Data końcowa:</label>
    <input type="date" class="form-control" name="end_date2" id="end_date2">
</div>


 
<div class="text-center">
 <center>
    <br>
 <button type = "submit" class="btn btn-primary">Filtruj</button>

 </center>
 <br>
 
 </div>
 
</form>
</div>
         
</div>             
</div>         
</div>

    <div class="row justify-content-center">


<center>
            <h3>    <div class="card-header">Urlop wypoczynkowy za okres:
            <br> {{$today2}} - {{$today3}}
            <br>@foreach($vacations_uw_suma as $vacuw)
            @if (!empty($vacuw->czas23))
<b> {{$vacuw->czas23}}</b> - łączna suma wykorzystanych dni urlopu wypoczynkowego
@else 
<b>0</b> - łączna suma wykorzystanych dni urlopu wypoczynkowego
@endif
@endforeach
            </div> </h3>
                 </center>
                 <div class="form-group"  style="margin-top: 30px;">
    <div class="row justify-content-center">
    <div class="form-row">              
<table class="table" id="vacuwTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i Imię:</th>
      <th scope="col">Liczba wykorzystanych dni:</th>
     



    </tr>
  </thead>
  <tbody>
  @foreach($vacations_uw as $vac) 

        
    <tr>
     
      <td class="table-row" data-href="{{action('VacationController@show2', $vac['user_id']) }}"><b>{{ $loop->iteration }}. {{$vac->user->surname}} {{$vac->user->name}}</b></td>
      <td class="table-row" data-href="{{action('VacationController@show2', $vac['user_id']) }}"><b>{{$vac->czas}} </b></td>

  
    </tr>


    @endforeach
</tbody>
</table>
</div>
</div>
</div>


<center>
          <h3>    <div class="card-header">Urlop chorobowy za okres:
            <br> {{$today2}} - {{$today3}}
            <br>@foreach($vacations_ch_suma as $vacuw)
            @if (!empty($vacuw->czas23))
<b> {{$vacuw->czas23}}</b> - łączna suma wykorzystanych dni urlopu chorobowego
@else 
<b>0</b> - łączna suma wykorzystanych dni urlopu chorobowego
@endif
@endforeach
            </div> </h3>
                 </center>
                 <div class="form-group"  style="margin-top: 30px;">
    <div class="row justify-content-center">
    <div class="form-row">                          
<table class="table" id="vacchTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i Imię:</th>
      <th scope="col">Liczba wykorzystanych dni:</th>
     



    </tr>
  </thead>
  <tbody>
  @foreach($vacations_ch as $vac) 

        
    <tr>
     
    <td class="table-row" data-href="{{action('VacationController@show4', $vac['user_id']) }}"><b>{{ $loop->iteration }}. {{$vac->user->surname}} {{$vac->user->name}}</b></td>
      <td class="table-row" data-href="{{action('VacationController@show4', $vac['user_id']) }}"><b>{{$vac->czas}} </b></td>


  
    </tr>


    @endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
@push('scripts')

<script>
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
@endpush
<style>
.table-row{
cursor:pointer;
}

</style>
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba osób: _TOTAL_",
      emptyTable: "Brak zdefiniowanych urlopów w dniu {{$today}}",
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

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#vacuwTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "",
      emptyTable: "Brak zdefiniowanych urlopów wypoczynkowych za okres {{$today2}} - {{$today3}}",
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
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#vacchTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "",
      emptyTable: "Brak zdefiniowanych urlopów chorobowych za okres {{$today2}} - {{$today3}}",
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
