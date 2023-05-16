<div class="form-floating mb-5">
    <select class="form-select" required id="{{ $name }}" aria-label="Floating label select example"
        name="{{ $name }}">
        {{ $slot }}
    </select>
    <label for="{{ $name }}">{{ $label }}</label>
</div>
