@csrf
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Mascota</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $pet->name ?? "") }}">
                </div>

                <div class="mb-3">
                    <label for="species" class="form-label">Especie de la Mascota</label>
                    <select class="form-control" name="species" id="species">
                        @include('pet.option-species',['val'=>$pet->species ?? ""])
                    </select>
                </div>  

                <div class="mb-3">
                    <label for="race" class="form-label">Raza de la Mascota</label>
                    <input type="text" class="form-control" id="race" name="race" value="{{ old('race', $pet->race ?? "") }}">
                </div>  

                <div class="mb-3">
                    <label for="sex" class="form-label">Sexo de la Mascota</label>
                    <select class="form-control" name="sex" id="sex">
                        <option value="femenino">Femenino</option>
                        <option value="masculino">Masculino</option>
                    </select>
                </div>  

                <div class="mb-3">
                    <label for="age" class="form-label">Edad de la Mascota</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{ old('age', $pet->age ?? "") }}">
                </div>  


                <div class="mb-3">
                    <label for="personality" class="form-label">Personalidad de la Mascota</label>
                    <select class="form-control" name="personality" id="personality">
                        @include('pet.option-personality',['val'=>$pet->personality ?? ""])
                    </select>
                </div>  

                <div class="mb-3">
                    <label for="commentary" class="form-label">Comentario a cerca de la Mascota</label>
                    <input type="text" class="form-control" id="commentary" name="commentary" value="{{ old('commentary', $pet->commentary ?? "") }}">
                </div>  



                <div class="mb-3">
                    <label for="size" class="form-label">Tamaño de la Mascota</label>
                    <select class="form-control" name="size" id="size">
                        @include('pet.option-size',['val'=>$pet->size ?? ""])
                    </select>
                </div>  

                <div class="mb-3">
                    <label>Imagen</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input">
                                <label class="custom-file-label"> Escoger archivo
                            </div>
                        </div>                                    
                </div>  
            </div>
        </div>
    </div>
</div>



