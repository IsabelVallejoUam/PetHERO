<div class="mb-3">
    <label for="route" class="form-label">Asignar ruta</label>
    <select name="route_id" class="form-control" id="route_id">
        @foreach ($routes as $route)
            <option value="{{$route->id}}">{{$route->title}}</option>
        @endforeach
    </select>
</div>  
<input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">