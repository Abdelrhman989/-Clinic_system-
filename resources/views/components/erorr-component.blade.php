@props(['name'])

@error($name)
    <div class="alert alert-danger">
        <strong>{{ $message }}</strong>
    </div>
@enderror