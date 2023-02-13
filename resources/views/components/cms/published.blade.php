@props(['value'])

<span @class([
    'badge',
    'bg-gradient-danger' => is_null($value),
    'bg-gradient-success' => !is_null($value),
])>
    @if (is_null($value))
        unpublished
    @else
        published
    @endif
</span>
