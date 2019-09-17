<div class="form-group">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul style="color: white;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
</div>
