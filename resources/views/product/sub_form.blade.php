<div class="mb-3">
    <label for="name" class="form-label">Nombre del producto</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? "") }}">
</div>
<div class="mb-3">
    <label for="price" class="form-label">Precio</label>
    <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price ?? "") }}">
</div>  
<div class="mb-3">
    <label for="discount" class="form-label">Descuento</label>
    <input type="text" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount ?? "") }}">
</div>  
<div class="mb-3">
    <label for="description" class="form-label">Describe tu producto</label>
    <textarea id="description" name="description" value="{{ old('description', $product->description ?? "") }}"></textarea> 
</div>  
<div class="mb-3">
    <label for="quantity" class="form-label">Cantidad disponible</label>
    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity ?? "") }}">
</div>  
<div class="mb-3">
    <label for="exampleFormControlSelect1">Tipo</label>
        <select name="type" class="form-control" id="type">
          <option value="producto" selected="selected">Producto</option>
          <option value="servicio">Servicio</option>
        </select>
</div>  

<div class="mb-3">
    <label>Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="photo" class="custom-file-input">
                <label class="custom-file-label"> Escoger archivo
            </div>
        </div>                                    
</div>  

<input type="hidden" name="store_id" id="store_id" value="{{$store_id}}">