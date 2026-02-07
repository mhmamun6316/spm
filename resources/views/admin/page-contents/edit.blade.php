@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 text-dark fw-bold">Page Content Settings</h1>
            <p class="text-muted">Manage Mission, Values, and Footer Information</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Page Content</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.page-contents.update') }}" method="POST" class="form-horizontal" id="pageContentForm">
                        @csrf
                        @method('PUT')

                        <!-- Mission Section -->
                        <div class="mb-4">
                            <h6 class="text-dark fw-bold border-bottom pb-2">
                                <i class="bi bi-target"></i> Mission
                            </h6>
                            <div class="mb-3">
                                <label for="mission" class="form-label">Mission Statement</label>
                                <textarea id="mission" name="mission" class="form-control @error('mission') is-invalid @enderror">{{ old('mission', $pageContent->mission) }}</textarea>
                                @error('mission')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Values Section -->
                        <div class="mb-4">
                            <h6 class="text-dark fw-bold border-bottom pb-2">
                                <i class="bi bi-star"></i> Our Values
                            </h6>
                            <div class="mb-3">
                                <label for="values" class="form-label">Company Values</label>
                                <textarea id="values" name="values" class="form-control @error('values') is-invalid @enderror">{{ old('values', $pageContent->values) }}</textarea>
                                @error('values')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Footer & Contact Information Section -->
                        <div class="mb-4">
                            <h6 class="text-dark fw-bold border-bottom pb-2">
                                <i class="bi bi-info-circle"></i> Footer & Contact Information
                            </h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name', $pageContent->company_name) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="footer_contact_email" class="form-label">Footer Contact Email (For 'E-mail Us' button)</label>
                                    <input type="email" id="footer_contact_email" name="footer_contact_email" class="form-control @error('footer_contact_email') is-invalid @enderror" value="{{ old('footer_contact_email', $pageContent->footer_contact_email) }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="footer_description" class="form-label">Footer Description</label>
                                    <textarea id="footer_description" name="footer_description" class="form-control @error('footer_description') is-invalid @enderror" rows="2">{{ old('footer_description', $pageContent->footer_description) }}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="copyright_text" class="form-label">Copyright Text</label>
                                    <input type="text" id="copyright_text" name="copyright_text" class="form-control @error('copyright_text') is-invalid @enderror" placeholder="e.g., Copyright © 2024 SPM Limited" value="{{ old('copyright_text', $pageContent->copyright_text) }}">
                                </div>
                            </div>

                            <!-- Social Media Links -->
                            <h6 class="text-secondary fw-bold mt-4 mb-3">Social Media Links</h6>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-facebook"></i> Facebook URL</label>
                                    <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $pageContent->facebook_url) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-linkedin"></i> LinkedIn URL</label>
                                    <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $pageContent->linkedin_url) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-twitter"></i> Twitter/X URL</label>
                                    <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $pageContent->twitter_url) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-youtube"></i> YouTube URL</label>
                                    <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $pageContent->youtube_url) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-instagram"></i> Instagram URL</label>
                                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $pageContent->instagram_url) }}">
                                </div>
                            </div>

                            <!-- Office Locations Note -->
                            <h6 class="text-secondary fw-bold mt-4 mb-3">Office Locations</h6>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Office locations are now managed separately. 
                                <a href="{{ route('admin.office-locations.index') }}" class="fw-bold">Click here to manage Footer Offices</a>.
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mb-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>

<script>
    $(document).ready(function() {
        const tinymceConfig = {
            height: 300,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatselect | fontsize | ' +
                'bold italic underline strikethrough | forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | table | ' +
                'removeformat | link image media | code fullscreen | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            font_size_formats: '8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 33px 34px 35px 36px 37px 38px 39px 40px 41px 42px 43px 44px 45px 46px 47px 48px',
            image_advtab: true,
            image_caption: true,
            image_dimensions: true,
            image_title: true,
            table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            table_appearance_options: false,
            table_grid: true,
            table_resize_bars: true,
            automatic_uploads: false,
            file_picker_types: 'image',
            paste_data_images: true,
            object_resizing: true,
            license_key: 'gpl',
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype === 'image') {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        const file = this.files[0];
                        if (!file) return;
                        if (file.size > 5 * 1024 * 1024) {
                            alert('Image size must be less than 5MB');
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            callback(e.target.result, {
                                alt: file.name,
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                }
            }
        };

        tinymce.init({
            ...tinymceConfig,
            selector: 'textarea[name="mission"]',
            placeholder: 'Enter mission statement...'
        });

        tinymce.init({
            ...tinymceConfig,
            selector: 'textarea[name="values"]',
            placeholder: 'Enter company values...'
        });

        $('#pageContentForm').on('submit', function() {
            tinymce.triggerSave();
        });
    });
</script>
@endpush

@endsection
