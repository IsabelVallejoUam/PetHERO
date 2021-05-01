<div class="mb-3">
    <label for="store_name" class="form-label">Nombre de la tienda</label>
    <input type="text" class="form-control" id="store_name" name="store_name" value="{{ old('store_name', $store->store_name ?? "") }}">
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
    <textarea id="description" name="description" value="{{ old('description', $store->description ?? "") }}">{{ old('description', $store->description ?? "") }}</textarea> 
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
    <label for="privacy">Privacidad</label>
    <select name="privacy" class="form-control" id="privacy">
        <option value="private" selected="selected">Privado (solo tú lo podrás ver)</option>
        <option value="public">Público (visible para todos los usuarios)</option>
    </select>
</div> 


<div class="mb-3">
    <label>Foto del establecimiento</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="photo" class="custom-file-input">
                <label class="custom-file-label"> Escoger archivo
            </div>
        </div>                                    
</div>  




