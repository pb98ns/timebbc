@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')

<div class="container">
@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="row justify-content-center">
      
  <center>
 <h3>    <div class="card-header">{{ __('Lista obecności') }} 
  
 
 
 <script>

$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczony plan pracy?"))
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



</div> </h3>
 </center>

                 
<table class="table" id="taskTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwisko i Imię:</th>
      <th scope="col">Data:</th>
      <th scope="col">Rodzaj:</th>
      <th scope="col">Data i czas zgłoszenia:</th>
      <th scope="col"></th>




    </tr>
  </thead>
  <tbody>
  @foreach($showuserplan as $projects) 
  <tr>
<td class="table-row" >{{ $loop->iteration }}. {{$projects->user->surname}} {{$projects->user->name}}</td> 
<td class="table-row" >{{$projects['plan_date']}}  ({{ \Carbon\Carbon::parse($projects['plan_date'])->translatedFormat('l') }})</td>  
<td class="table-row" >{{$projects['plan_type']}}</td>   
<td class="table-row" >{{$projects['modification_date']}} {{$projects['modification_time']}}</td>   
<td class="table-row">
      <form method = "post" class="delete_from" action="{{action('PlanController@delete2',$projects->id )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="bi bi-trash"></span></button>
      </form>
      </td> 
</tr>
  @endforeach

</tbody>
</table>

                 





@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#taskTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "",
      emptyTable: "Brak zdefiniowanych planów pracy",
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

@endsection
