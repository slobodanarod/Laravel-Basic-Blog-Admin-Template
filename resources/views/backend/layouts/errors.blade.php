@if(session('type'))

<div class="alert alert-{{ session('type') }}">
    {{ session('message') }}
</div>

@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
