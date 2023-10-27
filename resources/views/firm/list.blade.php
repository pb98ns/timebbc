@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
@section('content')
@if ($message = Session::get('success'))
<div class = "alert alert-success">
<p>{{$message}}</p>
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
                <center>
            <h3>    <div class="card-header">{{ __('Rejestracja klienta') }}</div> </h3>
                 </center>
                <div class="card-body">
<form action="{{action('FirmController@store')}}" method="POST" role="form">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa:') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" >

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
                                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" >

                                @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row text-center">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('Nip:') }}</label>

                            <div class="col-md-6">
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" >

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="container text-center">
                        
                 
                                          

<div class="form-check-inline row mx-auto">
              
<div class="col-mx-4 justify-content-center">
  <input class="form-check-input text-center" name="kpir" type="checkbox" value="KPIR" id="flexCheckDefault"/>
</div>
  <label class="form-check-label col-mx-4" for="flexCheckDefault" name="kpir">
    
    KPiR
  </label>
  
</div>

<div class="form-check-inline row mx-auto">
<div class="col-mx-4 justify-content-center">
  <input class="form-check-input" name="kh" type="checkbox" value="KH" id="flexCheckDefault2">
</div>     
  <label class="form-check-label col-mx-4" for="flexCheckDefault2" name="kh">
    Księgi Handlowe
  </label>

</div>

<div class="form-check-inline row mx-auto">
<div class="col-mx-4 justify-content-center">
  <input class="form-check-input" name="placezus" type="checkbox" value="PLACE" id="flexCheckDefault3">
</div>  
  <label class="form-check-label col-mx-4" for="flexCheckDefault3" name="placezus">
    Płace
  </label>

</div>
</div>

 
<input name="status" id="radio1" type="radio" id="inlineCheckbox1" value="Aktywny" checked>
 <style>
#radio1 {
    visibility: hidden;
}
  </style>
<br>
<br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                
     

                            </div>
                            <button type="submit" class="btn btn-success">
                                <center>
                                    {{ __('Zarejestruj klienta') }}
</center>
                                </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __('Lista klientów') }}</div> </h3>
                 </center>
           
<table class="table" id="firmTable">
  <thead>
    <tr>
      
     
      <th scope="col">Nazwa</th>
      <th scope="col">Nip</th>
      <th scope="col">Miejscowość</th>
      <th scope="col">KPiR</th>
      <th scope="col">Księgi Handlowe</th>
      <th scope="col">Płace</th>
      <th scope="col"></th>
      <th scope="col"></th>



    </tr>
  </thead>
  <tbody>
  @foreach($firmactive as $firms) 

        
    <tr>
     
      <td class="table-success table-row"><b>{{ $loop->iteration }}. {{$firms['name']}} {{$firms['number']}}</b></td>
      <td class="table-success table-row">{{$firms['nip']}}</td>
      <td class="table-success table-row">{{$firms['place']}}</td>
      <td class="table-success table-row">{{$firms['kpir']}}</td>
      <td class="table-success table-row">{{$firms['kh']}}</td>
      <td class="table-success table-row">{{$firms['placezus']}}</td>
      <td class="table-success table-row"><a href="{{action('FirmController@edit', $firms['id']) }}" class="btn btn-primary a-btn-slide-text" title="Edytuj">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>

    <td class="table-success table-row">
      <form method = "post" class="delete_from" action="{{action('FirmController@delete',$firms['id'] )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="bi bi-trash"></span></button>
      </form>
      </td> 
    </tr>


    @endforeach

    @foreach($firmnoactive as $firms) 

        
    <tr>
     
      <td class="table-danger table-row"><b>{{ $loop->iteration }}. {{$firms['name']}} {{$firms['number']}}</b></td>
      <td class="table-danger table-row">{{$firms['nip']}}</td>
      <td class="table-danger table-row">{{$firms['place']}}</td>
      <td class="table-danger table-row">{{$firms['kpir']}}</td>
      <td class="table-danger table-row">{{$firms['kh']}}</td>
      <td class="table-danger table-row">{{$firms['placezus']}}</td>
      <td class="table-danger table-row"><a href="{{action('FirmController@edit', $firms['id']) }}" class="btn btn-primary a-btn-slide-text" title="Edytuj">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>

    <td class="table-danger table-row">
      <form method = "post" class="delete_from" action="{{action('FirmController@delete',$firms['id'] )}}" title="Usuń">
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
if(confirm("Czy na pewno chcesz usunąć zaznaczonego klienta?"))
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
    $('#firmTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba klientów: _TOTAL_",
      emptyTable: "Brak zdefiniowanych klientów",
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
      "pageLength": 100

      
    });
} );
</script>
@endpush

@endsection
