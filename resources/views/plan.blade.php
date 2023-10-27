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

<div class="col-md-12">

<form action="{{action('PlanController@store')}}" method="POST" role="form">
@csrf

    <div class="form-row">

        <div class="form-group col-md-6 mx-auto">
            <label for="plan_date">Wybierz datę:</label>
            @error('plan_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            <input type="date" class="form-control @error('plan_date') is-invalid @enderror" name="plan_date" id="plan_date" value="plan_date" required autocomplete="plan_date" >
        </div>

        <div class="form-group col-md-6 mx-auto">

        <label for="cars">Wybierz rodzaj:</label>
<select class="form-select form-select-lg mb-2" name="plan_type" title="Wybierz rodzaj pracy">
  <option value="Praca - Biuro">Praca - Biuro</option>
  <option value="Praca - Wierchomla">Praca - Wierchomla</option>
  <option value="Praca zdalna">Praca zdalna</option>
<option value="W">W</option>
</select>
</div>





</div>




        
<input name="system" id="radio1" type="radio" id="inlineCheckbox1" value="1" checked>
 <style>
#radio1 {
    visibility: hidden;
}
  </style>
</div>


<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                
     

                            </div>
                            <button type="submit" class="btn btn-success">
                                <center>
                                    {{ __('Zgłoś') }}
</center>
                                </button>
                                
                        </div>
  
</form>







    
                <center>
            <h3>    <div class="card-header">{{ __('Zgłoszone obecności') }} 




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
      <form method = "post" class="delete_from" action="{{action('PlanController@delete',$projects->id )}}" title="Usuń">
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
