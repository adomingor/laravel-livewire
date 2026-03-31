@props(['options' => [5, 10, 15, 30, 50]])

<div class="flex items-center gap-2">
    <flux:text size="sm">{{ __('Mostrar') }}</flux:text>
    <flux:select {{ $attributes }} size="sm" class="w-24">
        @foreach ($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
        <option value="0">{{ __('Todos') }}</option>
    </flux:select>
    <flux:text size="sm">{{ __('registros') }}</flux:text>
</div>