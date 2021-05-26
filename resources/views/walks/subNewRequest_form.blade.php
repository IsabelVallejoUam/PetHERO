<div class="mb-3">
    <label for="requested_day" class="form-label">Día para el paseo</label>
    <input type="date" class="form-control" id="requested_day" name="requested_day" value="{{ old('requested_day', $walk->requested_day ?? "") }}">
</div>
<div class="mb-3">
    <label for="requested_hour" class="form-label">Hora para el paseo</label>
    <input class="form-control" type="time" id="requested_hour" name="requested_hour"> 
</div>
<div class="mb-3">
    <label for="min_time" class="form-label">Tiempo mínimo de paseo esperado</label>
    <input type="number" class="form-control" id="min_time" name="min_time" value="{{ old('min_time', $walk->min_time ?? "") }}">
</div>  
<div class="mb-3">
    <label for="max_time" class="form-label">Tiempo máximo esperado</label>
    <input type="number" class="form-control" id="max_time" name="max_time" value="{{ old('max_time', $walk->max_time ?? "") }}">
</div>  
<div class="mb-3">
    <label for="commentary" class="form-label">Comentarios adicionales</label>
    <input type="text" class="form-control" id="commentary" name="commentary" value="{{ old('schedule', $route->schedule ?? "") }}">
</div>  
<div class="mb-3">
    <label for="pet_id" class="form-label">Mascota para pasear</label>
    <select name="pet_id" class="form-control" id="pet_id">
        @foreach ($pets as $pet)
            <option value="{{$pet->id}}">{{$pet->name}} ({{$pet->race}})</option>
        @endforeach
    </select>
</div>  
<input type="hidden" name="walk_id" id="walk_id">
<input type="hidden" name="walker_id" id="walker_id">