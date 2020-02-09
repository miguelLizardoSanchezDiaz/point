@if(!$errors->isEmpty())
    <div class="alert alert-danger" style="margin-top: 10px;">
        <p><strong>Por favor corrige los siguientes errores:</strong></p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif