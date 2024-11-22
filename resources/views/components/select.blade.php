<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->

    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

</div>