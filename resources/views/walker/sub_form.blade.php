
<div class="mb-3">
    <label for="name" class="form-label">Tu nombre</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? "") }}">
</div>
<div class="mb-3">
    <label for="lastname" class="form-label">Tu apellido</label>
    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('slogan', $user->lastname ?? "") }}">
</div>  
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? "") }}">
</div>  
<div class="mb-3">
    <label for="document" class="form-label">Cédula</label>
    <input type="text" class="form-control" id="document" name="document" value="{{ old('document', $user->document ?? "") }}">
</div>  
<div class="mb-3">
    <label for="address" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? "") }}">
</div>  
<div class="mb-3">
    <label for="slogan" class="form-label">Slogan</label>
    <input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan', $walker->slogan ?? "") }}">
</div> 
<div class="mb-3">
    <label for="experience" class="form-label">Experiencia en años</label>
    <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience', $walker->experience ?? "") }}">
</div>  

{{-- <div class="mb-3">
    <label for="rate" class="form-label">Tarifa por paseo ($COP)</label>
    <input type="number" class="form-control" id="rate" name="rate" value="{{ old('rate', $walker->rate ?? "") }}">
</div>   
<div class="mb-3">
    <label for="schedule" class="form-label">Horario </label>
    <input type="text" class="form-control" id="schedule" name="schedule" value="{{ old('schedule', $walker->schedule ?? "") }}">
</div> --}}

<div class="mb-3">
    <label for="newpassword" class="form-label">Nueva contraseña</label>
    <input type="password" class="form-control" id="newpassword" name="newpassword" value="">
</div>

<div class="mb-3">
    <label for="newpasswordconfirmation" class="form-label">Confirmar nueva contraseña</label>
    <input type="password" class="form-control" id="newpasswordconfirmation" name="newpasswordconfirmation" value="">
</div>  

<div class="mb-3">
    <label>Foto de perfil</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="avatar" class="custom-file-input">
                <label class="custom-file-label"> Escoger archivo
            </div>
        </div>                                    
</div>  
