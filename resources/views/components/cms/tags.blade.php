@props(['value'])

<div>

    @if ($value)
        @foreach ($value as $tagData)
            <span class="badge bg-gradient-secondary"> {{ Str::limit($tagData, 10) }}</span>
        @endforeach
    @else
        <span class="badge bg-gradient-warning">-</span>
    @endif
    {{-- {{ \Carbon\Carbon::make($value)->diffForHumans() }} --}}
</div>
