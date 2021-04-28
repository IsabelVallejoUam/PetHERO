<div class="mb-3">
    <label for="store_name" class="form-label">Nombre de la tienda</label>
    <input type="text" class="form-control" id="store_name" name="store_name" value="{{ old('name', $store->name ?? "") }}">
</div>
<div class="mb-3">
    <label for="slogan" class="form-label">Slogan de la tienda</label>
    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan', $store->slogan ?? "") }}">
</div>  
<div class="mb-3">
    <label for="nit" class="form-label">NIT</label>
    <input type="text" class="form-control" id="nit" name="nit" value="{{ old('nit', $store->nit ?? "") }}">
</div>  
<div class="mb-3">
    <label for="description" class="form-label">Describe tu tienda</label>
    <textarea id="description" name="description" value="{{ old('description', $store->description ?? "") }}"></textarea> 
</div>  
<div class="mb-3">
    <label for="schedule" class="form-label">Tu horario</label>
    <input type="text" class="form-control" id="schedule" name="schedule" value="{{ old('schedule', $store->schedule ?? "") }}">
</div>  
<div class="mb-3">
    <label for="address" class="form-label">Dirección</label>
    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $store->address ?? "") }}">
</div>  

<div class="mb-3">
    <label for="phone_number" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $store->phone_number ?? "") }}">
</div>  

<div class="mb-3">
    <label for="exampleFormControlSelect1">Tipo de establecimiento</label>
        <select name="type" class="form-control" id="type">
          <option value="tienda" selected="selected">Tienda</option>
          <option value="veterinaria">Veterinaria</option>
        </select>
      </div>
</div>  


