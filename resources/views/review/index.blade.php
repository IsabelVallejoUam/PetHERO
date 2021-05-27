@extends ('layouts.app')
@section('content')
<div class="card container">
    <a type="button" class="btn btn-secondary mb-4 mt-2 " href="{{ url()->previous() }}" style="width: 100px;"><i class="far fa-hand-point-left"></i> Volver</a><br>
    @if ($type == 'store')
        <h1 style="text-align: center;">Reseñas de {{$store->store_name}}</h1><br>
    @elseif ($type == 'product')
        <h1 style="text-align: center;">Reseñas de {{$product->name}}</h1><br>
    @endif
    <div class="container">
        @foreach ($reviews as $review)
        <div class="card" style = "width: 20rem; margin:10px; display:inline-block;">
            <?php
                $author = App\Models\User::where('id',$review->user_id)->first();
            ?>
            <small><b>
                <div class="text-right" >Publicado el {{$review->created_at->format('d/m/Y')}}</div>
            </small></b>
            <h3>"<i><b>{{$review->commentary}}</i></b>"</h3>
            <h6> Escrito por: <u>{{$author->name}} </u></h6>
            <h6> Calificación: <u>{{$review->rate}}/5 </u></h6>
            <div class="card-body" style = "width: 20rem; margin:10px; display:inline-block;">
                <img class="card-img-top" src="/uploads/avatars/{{$author->avatar}}" style="border-radius: 2rem; padding:15px;width:200px;float:left; display:flex;" > 
            </div>
            <?php
                $count = App\Models\Review::where('user_id',$review->user_id)->count();
            ?>
            <p class="card-subtitle mb-2  text-center"><b>Contribuciones totales: {{$count}}</b></p>
            <br>
        </div> 
        @endforeach
    </div>        
</div>
@endsection