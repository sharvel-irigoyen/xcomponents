@props(['error' => false])
<div wire:ignore x-data x-init="

FilePond.setOptions({
    allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
            @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
        },
        revert: (filename, load) => {
            @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
        }
    },
    {{-- allowImagePreview: true, --}}
    {{-- imagePreviewTransparencyIndicator: '#f00',
    imagePreviewMarkupShow:false,
    imagePreviewMaxFileSize:'1MB', --}}
});
FilePond.create($refs.input)">
    <input type="file" x-ref="input" {{ $attributes }} class="@if ($error) is-invalid @endif">

</div>
@pushOnce('styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet" />
@endPushOnce
@pushOnce('scripts')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
@endPushOnce
