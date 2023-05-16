<div>
    <form action="{{ $action }}" method="{{ $method }}" class="was-validated">
        @csrf
        {{ $slot }}
    </form>
</div>
