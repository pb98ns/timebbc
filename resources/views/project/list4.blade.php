@extends('layouts.app')
@section('content')


<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">

 <center>
 <h4> <div class="card-header"><b>{{$project->firm->name}} {{ \Carbon\Carbon::parse($project->date)->format('Y-m-d') }} ({{ \Carbon\Carbon::parse($project->date)->translatedFormat('l') }}) </b>@if(!empty($showdayinview))
@foreach($showdayinview as $projects) 

<h4>
<b>Czas pracy:
{{ $projects->czas }}</b>
</h4>
@endforeach

@endif</div> </h4>
  
  </center>
 <div class="card-body">





 <table class="table" id="myTable">
  <thead>
    <tr>
    
    <th scope="col">Użytkownik</th>
      <th scope="col">Projekt</th>
      <th scope="col">Opis</th>
      <th scope="col">Czas</th>
      
     

    </tr>
  </thead>
  <tbody>
  @foreach($showday as $projects) 
    <tr>

<td>{{$projects->user->surname}} {{$projects->user->name}}   </td>   
<td>{{$projects->task->name}}</td>  
<td>{{$projects->description}}</td>  
<td>{{ \Carbon\Carbon::parse($projects->time)->format('H:i') }}</td> 

    </tr>
@endforeach
</tbody>
</table>



<br>

<script>
function goBack() {
  window.history.back();
}
</script>


<div class="form-group">
<center>
<button onclick="goBack()"class="btn btn-primary">Zamknij</button>
</center>
</div>

</form>

</div>
</div>
</div>
</div>
</div>
</div>


@endsection