@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
@push('scripts')

<script>
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
@endpush
<div class="container">
 
                <center>
            <h3>    <div class="card-header">{{ __('Urlopy oczekujące na potwierdzenie') }} </h3>
</center>
 

                 
<table class="table" id="taskTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i Imię:</th>
      <th scope="col">Data urlopu:</th>
      <th scope="col">Typ urlopu:</th>
      <th scope="col">Wymiar urlopu:</th>
      <th scope="col">Status:</th>
      <th scope="col"></th>
      <th scope="col"></th>




    </tr>
  </thead>
  <tbody>
  @foreach($vacations as $vac) 

        
    <tr>
     
      <td><b>{{ $loop->iteration }}. {{$vac->user->surname}} {{$vac->user->name}}</b></td>
      <td><b>{{$vac['vacation_date']}}  ({{ \Carbon\Carbon::parse($vac['vacation_date'])->translatedFormat('l') }})</b></td>
      @if($vac->type_vacation === "UW")
      <td><b>Urlop wypoczynkowy</b></td>
      @else
      <td><b>Urlop chorobowy</b></td>
      @endif
      <td><b>{{$vac['size']}}</b></td>
      <td><b>{{$vac['status1']}}</b></td>


  


    <td class="table-row"> <a href="{{action('VacationController@confirmvacation', $vac->czas) }}" class="btn btn-success a-btn-slide-text" title="Potwierdź">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>
<td class="table-row"><a href="{{action('VacationController@deletevacation', $vac->czas) }}" class="btn btn-danger a-btn-slide-text" title="Odrzuć">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>




    </tr>


    @endforeach
</tbody>
</table>


      
         
                <center>
         
@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#taskTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "",
      emptyTable: "Brak zdefiniowanych urlopów do potwierdzenia",
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

</div>

</div>

@endsection
