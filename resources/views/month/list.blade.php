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
<?php
$word = "TAK";
$date=$today;

?>
<div class="container">
<div class="container">
    <div class="row justify-content-center">
    <center>
 <h3>    <div class="card-header"> Planowane zgłoszenia deklaracji w dniu {{$end_date}} 
</h3>
</div> 
 </center>   
                <div class="card-body">
<form action="{{action('MonthController@store')}}" method="POST" role="form">
<input type="hidden" name="_token" value="{{csrf_token()}}" />






<div class="form-group col-md-6">
<input id="firm_id" type="hidden" data-width="100%" class="form-control @error('firm_id') is-invalid @enderror" name="firm_id" value="{{ old('firm_id') }}" required autocomplete="firm_id" >
<label for="firm_id"><b>Klient:</b></label>
<br>
@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <select name="firm_id" title="Wybierz klienta" class="selectpicker" data-live-search="true" data-width="100%" id="firm_id" required autocomplete="firm_id"  >


@foreach ($firm as $company)
<option name="firm_id" value="{{$company->id}}">{{$company->name}} </option>
@endforeach
</select>
</div>





<div class="form-group col-md-6">
<label for="okres"><b>Okres obrachunkowy:</b></label>

<select class="form-select form-select-lg mb-2" name="okres" title="Wybierz okres">
@for ($i = 1; $i <= 12; $i++)
        @php
            $date = \Carbon\Carbon::now()->subMonths($i);
        @endphp
        <option value="{{ $date->translatedFormat('F Y') }}">
            {{ $date->translatedFormat('F Y') }}
        </option>
    @endfor
  
  <option value="biezacy">bieżący ({{ \Carbon\Carbon::parse($today)->subMonth(0)->translatedFormat('F') }} {{ \Carbon\Carbon::parse($today)->subMonth(0)->translatedFormat('Y')}})</option>
  <option value="inny">inny okres obrachunkowy</option>
  <option value="nie">nie dotyczy</option>


</select> 
</div>
<input type="hidden" class="form-control" name="user_id"  value="{{Auth::user()->id}}"/>
<input type="hidden" class="form-control" name="close_date"  value="{{ \Carbon\Carbon::parse($today)->translatedFormat('Y-m-d') }}"/>
<input type="hidden" class="form-control" name="status1"  value="Zaplanowano"/>
</div>
</div>
<div class="container text-center">
<div class="justify-content-center">


<div class="form-check-inline row mx-auto">
  
              
  <div class="col-mx-4 justify-content-center">
    <input name="vat" type="radio" value="VAT-7" id="flexCheckDefault8"/>
    </div>
    <label class="form-check-label col-mx-4" for="flexCheckDefault8" name="vat">
      
      VAT-7
    </label>
 
  </div>
  <div class="form-check-inline row mx-auto ">
  
              
  <div class="col-mx-4 justify-content-center">
    <input name="vat" type="radio" value="PIT5/CIT2" id="flexCheckDefault9"/>
  </div>
    <label class="form-check-label col-mx-4" for="flexCheckDefault9" name="pit5_cit">
      
      PIT-5/CIT-2
    </label>
    
  </div>
       
<div class="form-check-inline row  mx-auto">
  
              
              <div class="col-mx-2 justify-content-center">
                <input class="form-check-input" name="vat" type="radio" value="VAT UE" id="flexCheckDefault"/>
              </div>
                <label class="form-check-label col-mx-2" for="flexCheckDefault" name="vat_ue">
                  
                  VAT UE
                </label>
                
              </div>
              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
                <input class="form-check-input" name="vat" type="radio" value="JPK" id="flexCheckDefault2">
              </div>     
                <label class="form-check-label col-mx-2" for="flexCheckDefault2" name="vat_uea">
                  JPK
                </label>
              
              </div>
              
         






              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
                <input class="form-check-input" name="vat" type="radio" value="AKCYZA" id="flexCheckDefault6">
              </div>     
                <label class="form-check-label col-mx-2" for="flexCheckDefault6" name="akc">
                  AKCYZA
                </label>
              
              </div>
              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
                <input class="form-check-input" name="vat" type="radio" value="CIT-ST" id="flexCheckDefault7">
              </div>  
                <label class="form-check-label col-mx-2" for="flexCheckDefault7" name="cit_st">
                  CIT-ST
                </label>
                
              </div>
              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
                <input class="form-check-input" name="vat" type="radio" value="INNE" id="flexCheckDefault88">
              </div>  
                <label class="form-check-label col-mx-2" for="flexCheckDefault88" name="amortyzacja">
                  INNE
                </label>
                
              </div>
              <script>


$('input[id=flexCheckDefault88]').click(function() {
  if (!$('input[id=flexCheckDefault88]').is(':checked')) {    
  }
  else
        alert('Informacja: Jeśli zgłaszasz inną deklarację lub korektę deklaracji niezdefiniowanej jeszcze w systemie, proszę o wpisanie szczegółowych informacji w polu "Uwagi".');
});
  </script>          
              </div>


<br>




              <div class="form-group col-md-12">
<label for="uwagi"><b>Uwagi do deklaracji:</b></label>

<div class="input-group">
<div class="input-group-prepend">
  </div>
  <input rows="1" class="form-control" style="webkit-border-radius: 5px; moz-border-radius: 5px; border-radius: 5px;" id="textarea" name="uwagi" aria-label="With textarea" />
</div>
<br> 




              <br>
              <div class="form-group row mb-0">
                        
                        <input type="submit" value="Zaplanuj deklarację do realizacji" class="btn btn-success" />
                       
                        </form>
                        </div>
              </div>
              </div>
             












                     
                </div>
    </div>
    <div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __('Lista zgłoszeń deklaracji w okresie od') }} {{$start_date}} do {{$end_date}}</div> </h3>
                 </center>
                 <div class="form-group col-md-6"  style="margin-top: 30px;">
    <div class="row justify-content-center">
    <div class="form-row">
     <form action="{{action('MonthController@searchperiod')}}" method="POST" role="form">
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
    <table class="table" id="myTable" data-show-footer="true">
  <thead>
    <tr>
    
    <th scope="col">Klient</th>
    <th scope="col">Deklaracje</th>
    <th scope="col">Data i czas</th>
    <th scope="col">Status</th>
    <th scope="col">Przelew</th>
    <th scope="col">Potwierdzenie</th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>

     

    </tr>
  </thead>
  <tbody>
  
  @foreach($project2 as $projects) 
    <tr>
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{ $loop->iteration }}. {{$projects->firm->name}}</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}"> {{$projects->vat}} {{$projects->pit5_cit}} {{$projects->vat_ue}} {{$projects->vat_uea}} {{$projects->vat_uec}} {{$projects->akc}} {{$projects->cit_st}}  {{$projects->amortyzacja}} @if(!empty($projects->korekta)) <b>(korekta)</b> @endif</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->close_date}} {{$projects->close_time}}</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->status1}} </td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->vat_ueb}} </td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}">@if(!empty($projects->usertwo->name)) {{$projects->close_date2}} {{$projects->close_time2}}  {{$projects->usertwo->name}} {{$projects->usertwo->surname}} @endif</td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}"></td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}"></td> 
<td class="table-danger table-row" data-href="{{action('MonthController@show', $projects->id) }}"></td> 

            
    </a></td>

  

 


    </tr>
    @endforeach

    @foreach($project5 as $projects) 
    <tr>
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{ $loop->iteration }}. {{$projects->firm->name}}</td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->id) }}"> {{$projects->vat}} {{$projects->pit5_cit}} {{$projects->vat_ue}} {{$projects->vat_uea}} {{$projects->vat_uec}} {{$projects->akc}} {{$projects->cit_st}}  {{$projects->amortyzacja}} @if(!empty($projects->korekta)) <b>(korekta)</b> @endif</td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->close_date}} {{$projects->close_time}}</td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->status1}} </td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->vat_ueb}} </td> 
<td class="table-warning table-row" data-href="{{action('MonthController@show', $projects->id) }}">@if(!empty($projects->usertwo->name)) {{$projects->close_date2}} {{$projects->close_time2}}  {{$projects->usertwo->name}} {{$projects->usertwo->surname}} @endif</td> 







    <td class="table-warning table-row" data-href="{{action('MonthController@updatedec', $projects->id) }}"><a href="{{URL::to('/home/month_end_closing/update/'.$projects->id)}}" class="btn btn-success a-btn-slide-text" title="Potwierdź deklarację">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <span><strong></strong></span>            
    </a></td>




     <td class="table-warning table-row" data-href="{{action('MonthController@editdeclaration', $projects->id) }}" ><a href="{{URL::to('/home/month_end_closing/editdeclaration/'.$projects->id)}}" class="btn btn-primary a-btn-slide-text" title="Edytuj deklarację">
  
      
      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong></strong></span>           
      
</td>  


<td class="table-warning table-row">
      <form method = "post" class="delete_from2" action="{{action('MonthController@delete2',$projects->id )}}" title="Usuń deklarację">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        <span><strong></strong></span>    </button>
      </form>
</td>  


    </tr>
    @endforeach

    @foreach($project4 as $projects) 
    <tr>
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}" >{{ $loop->iteration }}. {{$projects->firm->name}}</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}"> {{$projects->vat}} {{$projects->pit5_cit}} {{$projects->vat_ue}} {{$projects->vat_uea}} {{$projects->vat_uec}} {{$projects->akc}} {{$projects->cit_st}} {{$projects->amortyzacja}} @if(!empty($projects->korekta)) <b>(korekta)</b> @endif</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->close_date}} {{$projects->close_time}}</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}">{{$projects->status1}}</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}">@if(!empty($projects->vat_ueb) || ((str_contains($projects->przelew, 'TAK')))) {{$projects->vat_ueb}} @else NIE @endif</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}">@if(!empty($projects->usertwo->name)) {{$projects->close_date2}} {{$projects->close_time2}}  {{$projects->usertwo->name}} {{$projects->usertwo->surname}} @endif</td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}"></td>
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}"></td> 
<td class="table-success table-row" data-href="{{action('MonthController@show', $projects->id) }}"><a href="{{URL::to('/home/month_end_closing/revision/'.$projects->id)}}" class="btn btn-danger a-btn-slide-text" title="Zgłoś korektę">
        
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
<br>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "_TOTAL_ - liczba zapisanych zgłoszeń w okresie od {{$start_date}} do {{$end_date}}",
      emptyTable: "Brak zdefiniowanych zgłoszeń na przygotowanie deklaracji w okresie od {{$start_date}} do {{$end_date}}",
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
           


