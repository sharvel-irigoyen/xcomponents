@props(['error' => false])
<textarea {{ $attributes }} class="form-control fs-5 @if ($error) is-invalid @endif"></textarea>
