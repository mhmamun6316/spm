@props(['name', 'id', 'label', 'value' => null, 'width' => 1200, 'height' => 600, 'required' => false])

<div class="form-group mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    <div class="input-group">
        <input type="file" class="form-control" id="{{ $id }}_input" accept="image/*" onchange="initCropper('{{ $id }}', this)">
        <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
    </div>
    
    <!-- Image Preview Area -->
    <div class="mt-2" id="{{ $id }}_preview_container" {!! $value ? '' : 'style="display: none;"' !!}>
        <img src="{{ $value ? asset('storage/' . $value) : '' }}" id="{{ $id }}_preview" class="img-fluid rounded border" style="max-height: 200px;">
    </div>
</div>

<!-- Cropper Modal -->
<div class="modal fade" id="{{ $id }}_cropper_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="img-container" style="max-height: 500px;">
                    <img id="{{ $id }}_cropper_image" src="" style="max-width: 100%; display: block;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="cropImage('{{ $id }}', {{ $width }}, {{ $height }})">Crop & Save</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
<style>
    .img-container img {
        max-width: 100%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
    let croppers = {};

    function initCropper(id, input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const modalId = `#${id}_cropper_modal`;
                const imageId = `${id}_cropper_image`;
                const image = document.getElementById(imageId);
                
                // Set the image source
                image.src = e.target.result;
                
                // Show modal
                const modal = new bootstrap.Modal(document.querySelector(modalId));
                modal.show();
                
                // Initialize cropper when modal is shown
                document.querySelector(modalId).addEventListener('shown.bs.modal', function () {
                    if (croppers[id]) {
                        croppers[id].destroy();
                    }
                    
                    croppers[id] = new Cropper(image, {
                        aspectRatio: {{ $width }} / {{ $height }},
                        viewMode: 1,
                        autoCropArea: 1,
                    });
                }, { once: true });
                
                // Clean up when modal is hidden
                document.querySelector(modalId).addEventListener('hidden.bs.modal', function () {
                    if (croppers[id]) {
                        croppers[id].destroy();
                        croppers[id] = null;
                    }
                    input.value = ''; // Reset input
                }, { once: true });
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function cropImage(id, width, height) {
        if (!croppers[id]) return;
        
        const canvas = croppers[id].getCroppedCanvas({
            width: width,
            height: height
        });
        
        canvas.toBlob(function(blob) {
            // Convert to base64 for submission
            const reader = new FileReader();
            reader.readAsDataURL(blob); 
            reader.onloadend = function() {
                const base64data = reader.result;
                
                // Store base64 data in hidden input
                document.getElementById(id).value = base64data;
                
                // Show preview
                const preview = document.getElementById(`${id}_preview`);
                preview.src = base64data;
                
                const previewContainer = document.getElementById(`${id}_preview_container`);
                previewContainer.style.display = 'block';
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById(`${id}_cropper_modal`));
                modal.hide();
            }
        }, 'image/jpeg', 0.9);
    }
    
    function removeImage(id) {
        document.getElementById(id).value = '';
        document.getElementById(`${id}_preview`).src = '';
        document.getElementById(`${id}_preview_container`).style.display = 'none';
        document.getElementById(`${id}_input`).value = '';
    }
</script>
@endpush
