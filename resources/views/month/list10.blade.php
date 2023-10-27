@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
@endsection
@section('content')

    <div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __(' Księgi Handlowe - deklaracje zaplanowane i zgłoszone do realizacji') }} </div> </h3>
                 </center>

    <table class="table" id="myTable" data-show-footer="true">
  <thead>
    <tr>
    
    <th scope="col">Klient</th>
    <th scope="col">Deklaracje (okres)</th>
    <th scope="col">Użytkownik</th>
    <th scope="col">Data i czas</th>
    <th scope="col">Status</th>
    <th scope="col">Uwagi</th>
    <th scope="col"></th>


   
     

    </tr>
  </thead>
  <tbody>

    @foreach($project4 as $projects) 
    <tr>
<td class="table-danger table-row" data-href="{{action('MonthController@showkh', $projects->czas) }}" >{{ $loop->iteration }}. {{$projects->firm->name}} @if(!empty($projects->firm->number)) ({{$projects->firm->number}}) @endif</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@showkh', $projects->czas) }}"> {{$projects->vat}} {{$projects->pit5_cit}} {{$projects->vat_ue}} {{$projects->vat_uea}} {{$projects->vat_uec}} ({{$projects->vat_27}}) {{$projects->akc}} {{$projects->cit_st}} {{$projects->amortyzacja}} @if(!empty($projects->korekta)) <b>(korekta)</b> @endif</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@showkh', $projects->czas) }}">{{$projects->user->name}} {{$projects->user->surname}}</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@showkh', $projects->czas) }}">{{$projects->close_date}} {{$projects->close_time}}</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@showkh', $projects->czas) }}"><b>{{$projects->status1}}<b></td> 
<td class="table-danger table-row" data-href="{{action('MonthController@showkh', $projects->czas) }}">@if(!empty($projects->uwagi || $projects->uwagidokorekty))TAK @else NIE  @endif</td> 


    <td class="table-danger">
      <form method = "post" class="delete_from2" action="{{action('MonthController@deletekh',$projects->czas )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
      </form>
</td>  

 


    </tr>
    @endforeach
    @foreach($project6 as $projects) 
    <tr>
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->czas) }}" >{{ $loop->iteration }}. {{$projects->firm->name}} @if(!empty($projects->firm->number)) ({{$projects->firm->number}}) @endif</td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->czas) }}"> {{$projects->vat}} {{$projects->pit5_cit}} {{$projects->vat_ue}} {{$projects->vat_uea}} {{$projects->vat_uec}} ({{$projects->vat_27}}) {{$projects->akc}} {{$projects->cit_st}} {{$projects->amortyzacja}} @if(!empty($projects->korekta)) <b>(korekta)</b> @endif</td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->czas) }}">{{$projects->user->name}} {{$projects->user->surname}}</td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->czas) }}">{{$projects->close_date}} {{$projects->close_time}}</td>
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->czas) }}"><b>{{$projects->status1}}<b></td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->czas) }}">@if(!empty($projects->uwagi || $projects->uwagidokorekty))TAK @else NIE  @endif</td> 


    <td class="table-warning">
      <form method = "post" class="delete_from2" action="{{action('MonthController@deletekh',$projects->czas )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
      </form>
</td>  

 


    </tr>
    @endforeach
</tbody>
</table>


</div>
</div>
</div>
</div>
<br>












<div class="container">
    <div class="row justify-content-center">
    <div class="form-group col-md-6"  style="margin-top: 30px;">
<div class="row justify-content-center">
    <div class="form-row">
     <form action="{{action('MonthController@searchkh')}}" method="POST" role="form">
     @csrf
<div class="form-group col-md-4">
    <label for="start_date">Data początkowa:</label>
    <input type="date" class="form-control" name="start_date" id="start_date" >
</div>

<div class="form-group col-md-4">
    <label for="end_date">Data końcowa:</label>
    <input type="date" class="form-control" name="end_date" id="end_date">
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
         
                <center>
            <h3>    <div class="card-header">{{ __(' Księgi Handlowe - deklaracje zrealizowane w okresie od') }} {{$start_date}} do {{$end_date}}</div> </h3>
                 </center>

    <table class="table" id="myTable2" data-show-footer="true">
  <thead>
    <tr>
    
    <th scope="col">Klient</th>
    <th scope="col">Deklaracje (okres)</th>
    <th scope="col">Użytkownik zgłaszający</th>
    <th scope="col">Data i czas</th>
    <th scope="col">Przelew</th>
    <th scope="col"></th>
    <th scope="col"></th>
   
     
 
    </tr>
  </thead>
  <tbody>

    @foreach($project2 as $projects) 
    <tr>
    <td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}" >{{ $loop->iteration }}. {{$projects->firm->name}} @if(!empty($projects->firm->number)) ({{$projects->firm->number}}) @endif</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}"> {{$projects->vat}} {{$projects->pit5_cit}} {{$projects->vat_ue}} {{$projects->vat_uea}} {{$projects->vat_uec}} ({{$projects->vat_27}}) {{$projects->akc}} {{$projects->cit_st}} {{$projects->amortyzacja}} @if(!empty($projects->korekta)) <b>(korekta)</b> @endif</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}">{{$projects->user->name}} {{$projects->user->surname}}</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}">{{$projects->close_date}} {{$projects->close_time}}</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}">@if(!empty($projects->vat_ueb) || ((str_contains($projects->przelew, 'TAK')))) {{$projects->vat_ueb}} @else NIE @endif</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}"><a href="{{URL::to('/home/month_end_closing/update_kh_status/'.$projects->czas)}}" class="btn btn-primary a-btn-slide-text" title="Cofnij potwierdzenie">
        <span  aria-hidden="true"></span>
        <span>COFNIJ</span>            
    </a></td>
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->czas) }}"><a href="{{URL::to('/home/month_end_closing/revision/'.$projects->czas)}}" class="btn btn-danger a-btn-slide-text" title="Zgłoś korektę">
        <span aria-hidden="true"></span>
        <span>KOREKTA</span>            
    </a></td>

    

 


    </tr>
    @endforeach
</tbody>
</table>


</div>
</div>
</div>
</div>









<div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __(' Księgi Handlowe - deklaracje niezrealizowane w okresie od') }} {{$start_date}} do {{$end_date}}</div> </h3>
                 </center>

    <table class="table" id="myTable3" data-show-footer="true">
  <thead>
    <tr>
    
    <th scope="col">Klient</th>
    <th scope="col">Adres</th>
    <th scope="col">NIP</th>


    
    </tr>
  </thead>
  <tbody>

    @foreach($project22 as $projects) 
    <tr>
<td class="table-danger">{{ $loop->iteration }}. {{$projects->name}} @if(!empty($projects->number)) ({{$projects->number}}) @endif</td> 
<td class="table-danger">{{$projects->place}}</td> 
<td class="table-danger">{{$projects->nip}}</td> 


    </tr>
    @endforeach
</tbody>
</table>
<script>

$(document).ready(function()
{
$('.delete_from2').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczoną deklarację?"))
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
</div>
</div>


<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "_TOTAL_ - liczba zapisanych zgłoszeń do utworzenia deklaracji",
      emptyTable: "Brak zdefiniowanych zgłoszeń na przygotowanie deklaracji",
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
      "pageLength": 25

      
    });
} );
</script>


<script>
   $(document).ready( function () {
    $('#myTable2').DataTable({
      "language": {
      infoEmpty:"",
      info: "_TOTAL_ - liczba przygotowanych deklaracji w okresie od {{$start_date}} do {{$end_date}}",
      emptyTable: "Brak przygotowanych deklaracji w okresie od {{$start_date}} do {{$end_date}}",
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
      "pageLength": 25

      
    });
} );
</script>

<script>
   $(document).ready( function () {
    $('#myTable3').DataTable({
      "language": {
      infoEmpty:"",
      info: "_TOTAL_ - liczba niezrealizowanych deklaracji w okresie od {{$start_date}} do {{$end_date}}",
      emptyTable: "W okresie od {{$start_date}} do {{$end_date}} deklaracje zostały zgłoszone dla wszystkich klientów",
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
      "pageLength": 25

      
    });
} );
</script>
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


@endsection
           


