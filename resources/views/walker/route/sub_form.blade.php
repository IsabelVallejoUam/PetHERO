<div class="mb-3">
    <label for="title" class="form-label">Nombre de la ruta</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $route->title ?? "") }}">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Describe tu ruta</label>
    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $route->description ?? "") }}">
</div>  
<div class="mb-3">
    <label for="duration" class="form-label">Duración aproximada (en horas)</label>
    <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $route->duration ?? "") }}">
</div>  
<div class="mb-3">
    <label for="schedule" class="form-label">Horario de ruta (días y horas)</label>
    <input type="text" class="form-control" id="schedule" name="schedule" value="{{ old('schedule', $route->schedule ?? "") }}">
</div>  
<div class="mb-3">
    <label for="price" class="form-label">Precio por paseo</label>
    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $route->price ?? "") }}">
</div>  

<div class="mb-3">
    <label for="privacy">Privacidad</label>
    <select name="privacy" class="form-control" id="privacy">
        <option value="private" selected="selected">Privado (solo tú lo podrás ver)</option>
        <option value="public">Público (visible para todos los usuarios)</option>
    </select>
</div> 