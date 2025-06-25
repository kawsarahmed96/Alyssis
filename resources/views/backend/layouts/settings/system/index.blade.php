@extends('backend.master')

@section('title', 'System Settings')

@section('content')
    <div class="row mb-5">
        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">System / Website Settings</h4>

                    <form method="POST" action="{{ route('system.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3 row">
                            <label for="title" class="col-sm-4 col-form-label form-label">Website Title</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $system->title ?? '') }}" placeholder="Enter Title" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $system->email ?? '') }}" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <!-- Logo -->
                        <div class="mb-3 row align-items-center">
                            <label for="logo" class="col-sm-4 col-form-label form-label">Logo</label>
                            <div class="col-md-8 d-flex gap-3 flex-wrap">
                                <input type="file" class="form-control w-50" id="logo" name="logo"
                                    onchange="previewImage(this, 'logoPreview')">

                                <!-- New Preview -->
                                <div class="border rounded p-1">
                                    <img id="logoPreview" src="#" alt="New Logo Preview"
                                        style="max-height: 60px; display: none;">
                                </div>

                                <!-- Current Logo -->
                                @if (!empty($system->logo))
                                    <div class="border rounded p-1">
                                        <img src="{{ asset($system->logo) }}" alt="Current Logo" style="max-height: 60px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Favicon -->
                        <div class="mb-3 row align-items-center">
                            <label for="favicon" class="col-sm-4 col-form-label form-label">Favicon</label>
                            <div class="col-md-8 d-flex gap-3 flex-wrap">
                                <input type="file" class="form-control w-50" id="favicon" name="favicon"
                                    onchange="previewImage(this, 'faviconPreview')">

                                <!-- New Preview -->
                                <div class="border rounded p-1">
                                    <img id="faviconPreview" src="#" alt="New Favicon Preview"
                                        style="max-height: 60px; display: none;">
                                </div>

                                <!-- Current Favicon -->
                                @if (!empty($system->favicon))
                                    <div class="border rounded p-1">
                                        <img src="{{ asset($system->favicon) }}" alt="Current Favicon"
                                            style="max-height: 60px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="mb-3 row">
                            <label for="copyright" class="col-sm-4 col-form-label form-label">Copyright</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="copyright" name="copyright"
                                    value="{{ old('copyright', $system->copyright ?? '') }}"
                                    placeholder="© Company Name 2025" required>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endpush
