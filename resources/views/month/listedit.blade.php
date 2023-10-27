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
 <h3>    <div class="card-header"> Edytuj deklarację 
</h3>
</div> 
 </center>   
                <div class="card-body">
<form method="post" action = "{{action('MonthController@updatedeclaration', $project->id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />






<div class="form-group col-md-6">
<input type="hidden" name='firm_id'>
<label for="firm_id"><b>Klient:</b></label>
<select class="form-select form-select-lg mb-2" name="firm_id"  >
 name="firm_id"  >
@foreach ($firm as $firms)
<option name="firm_id" 
value="{{$firms->id}}"
@if ($firms->id === $project->firm_id)
selected
@endif
>
{{$firms->name}}
</option>
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
        <option value="{{ $date->translatedFormat('F Y') }}"
        @if ($date->translatedFormat('F Y') === $project->vat_27)
selected
@endif
>
            {{ $date->translatedFormat('F Y') }}
        </option>
    @endfor
  
  <option value="biezacy">bieżący ({{ \Carbon\Carbon::parse($today)->subMonth(0)->translatedFormat('F') }} {{ \Carbon\Carbon::parse($today)->subMonth(0)->translatedFormat('Y')}})</option>
  <option value="inny">inny okres obrachunkowy</option>
  <option value="nie">nie dotyczy</option>


</select> 
</div>
<input type="hidden" class="form-control" name="user_id"  value="{{Auth::user()->id}}"/>
<input type="hidden" class="form-control" name="status1"  value="Zaplanowano"/>
</div>
</div>
<div class="container text-center">
<div class="justify-content-center">


<div class="form-check-inline row mx-auto">
  
              
  <div class="col-mx-4 justify-content-center">
  @if($project->vat == 'VAT-7')
    <input name="vat" type="radio" value="VAT-7" id="flexCheckDefault8" checked/>
  @endif
  @if($project->vat != 'VAT-7')
    <input name="vat" type="radio" value="VAT-7" id="flexCheckDefault8" />
  @endif
    </div>
    <label class="form-check-label col-mx-4" for="flexCheckDefault8" name="vat" >
      
      VAT-7
    </label>
 
  </div>
  <div class="form-check-inline row mx-auto ">
  
              
  <div class="col-mx-4 justify-content-center">
  @if($project->vat=='PIT5/CIT2')

    <input name="vat" type="radio" value="PIT5/CIT2" id="flexCheckDefault9" checked/>
    @endif

  @if($project->vat != 'PIT5/CIT2')

<input name="vat" type="radio" value="PIT5/CIT2" id="flexCheckDefault9" />
@endif
  </div>
    <label class="form-check-label col-mx-4" for="flexCheckDefault9" name="pit5_cit">
      
      PIT-5/CIT-2
    </label>
    
  </div>
       
<div class="form-check-inline row  mx-auto">
  
              
              <div class="col-mx-2 justify-content-center">
              @if($project->vat == 'VAT UE')
                <input class="form-check-input" name="vat" type="radio" value="VAT UE" id="flexCheckDefault" checked/>
              @endif
              @if($project->vat != 'VAT UE')
                <input class="form-check-input" name="vat" type="radio" value="VAT UE" id="flexCheckDefault"/>
              @endif
              </div>
                <label class="form-check-label col-mx-2" for="flexCheckDefault" name="vat_ue">
                  
                  VAT UE
                </label>
                
              </div>
              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
              @if($project->vat == 'JPK')
                <input class="form-check-input" name="vat" type="radio" value="JPK" id="flexCheckDefault2" checked>
              @endif
              @if($project->vat != 'JPK')
                <input class="form-check-input" name="vat" type="radio" value="JPK" id="flexCheckDefault2" >
              @endif
              </div>     
                <label class="form-check-label col-mx-2" for="flexCheckDefault2" name="vat_uea">
                  JPK
                </label>
              
              </div>
              
         






              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
              @if($project->vat == 'AKCYZA')
                <input class="form-check-input" name="vat" type="radio" value="AKCYZA" id="flexCheckDefault6" checked>
              @endif
              @if($project->vat != 'AKCYZA')
                <input class="form-check-input" name="vat" type="radio" value="AKCYZA" id="flexCheckDefault6">
              @endif
              </div>     
                <label class="form-check-label col-mx-2" for="flexCheckDefault6" name="akc">
                  AKCYZA
                </label>
              
              </div>
              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
              @if($project->vat == 'CIT-ST')
                <input class="form-check-input" name="vat" type="radio" value="CIT-ST" id="flexCheckDefault7" checked>
              @endif
              @if($project->vat != 'CIT-ST')
                <input class="form-check-input" name="vat" type="radio" value="CIT-ST" id="flexCheckDefault7">
              @endif
              </div>  
                <label class="form-check-label col-mx-2" for="flexCheckDefault7" name="cit_st">
                  CIT-ST
                </label>
                
              </div>
              
              <div class="form-check-inline row  mx-auto">
              <div class="col-mx-2 justify-content-center">
              @if($project->vat == 'INNE')

                <input class="form-check-input" name="vat" type="radio" value="INNE" id="flexCheckDefault88" checked>
              @endif
              @if($project->vat != 'INNE')

                <input class="form-check-input" name="vat" type="radio" value="INNE" id="flexCheckDefault88">
              @endif
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
  <input rows="1" class="form-control" style="webkit-border-radius: 5px; moz-border-radius: 5px; border-radius: 5px;" id="textarea" name="uwagi" aria-label="With textarea" value="{{$project->uwagi}}">
</div>
<br> 




              <br>
              <div class="form-group">
                        <center>
                        <input type="submit" value="Zapisz zmiany" class="btn btn-primary" />
                        <a href="{{url()->previous()}}" type="button" class="btn btn-danger">Anuluj zmiany</a>
</center>
                        </form>
                        </div>
                       
              </div>
              </div>
             












                     
                </div>
    </div>
</div>
<br>

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
           


