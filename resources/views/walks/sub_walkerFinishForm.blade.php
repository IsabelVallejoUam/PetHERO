<div class="mb-3">
    <label for="minutes" class="form-label">Cuántos minutos caminaste</label>
    <input type="number" class="form-control" id="minutes" name="minutes" value="{{ old('requested_day', $walk->requested_day ?? "") }}">
</div>
<div class="mb-3">
    <label for="petCalification" class="form-label">Cómo calificas a {{$walk->pet->name}}</label>
    <input type="number" class="form-control" id="petCalification" name="petCalification" value="{{ old('requested_day', $walk->requested_day ?? "") }}">
</div>
<input type="hidden" name="walk_id" value="{{$walk->id}}" id="walk_id">
                                            