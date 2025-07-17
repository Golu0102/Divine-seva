@extends('superadmin.layouts.master')

@section('title', 'Site Settings')
@section('page-title', 'Manage Site Settings')

@section('content')
    <div class="card p-4">
        {{-- @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}
        <form action="{{ route('superadmin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Logo -->
                <div class="col-md-6 mb-3">
                    <label>Site Logo</label><br>
                    @if ($setting->logo)
                        <img src="{{ asset($setting->logo) }}" alt="Logo" height="80">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="delete_logo" value="1"
                                id="delete_logo">
                            <label class="form-check-label" for="delete_logo">Delete current logo</label>
                        </div>
                    @endif

                    <input type="file" name="logo" class="form-control mt-2">
                </div>


                <!-- Footer Text -->
                <div class="col-md-6 mb-3">
                    <label>Footer Text</label>
                    <input type="text" name="footer_text" class="form-control" value="{{ $setting->footer_text }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $setting->site_name }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $setting->address }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control" value="{{ $setting->mobile }}">
                </div>

                <!-- Social Links -->
                <div class="col-md-6 mb-3">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{ $setting->twitter }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>YouTube</label>
                    <input type="text" name="youtube" class="form-control" value="{{ $setting->youtube }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="blog_1" class="form-label">Blog 1</label>
                    <textarea class="form-control" name="blog_1">{{ old('blog_1', $setting->blog_1) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="blog_2" class="form-label">Blog 2</label>
                    <textarea class="form-control" name="blog_2">{{ old('blog_2', $setting->blog_2) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="blog_3" class="form-label">Blog 3</label>
                    <textarea class="form-control" name="blog_3">{{ old('blog_3', $setting->blog_3) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="blog_4" class="form-label">Blog 4</label>
                    <textarea class="form-control" name="blog_4">{{ old('blog_4', $setting->blog_4) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="blog_5" class="form-label">Blog 5</label>
                    <textarea class="form-control" name="blog_5">{{ old('blog_5', $setting->blog_5) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="blog_6" class="form-label">Blog 6</label>
                    <textarea class="form-control" name="blog_6">{{ old('blog_6', $setting->blog_6) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="blog_7" class="form-label">Blog 7</label>
                    <textarea class="form-control" name="blog_7">{{ old('blog_7', $setting->blog_7) }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Experienced Pandit Image</label><br>

                    @if ($setting->experienced_pandit_image)
                        <img src="{{ asset($setting->experienced_pandit_image) }}" alt="Experienced Pandit"
                            height="80">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="delete_experienced_pandit_image"
                                value="1" id="delete_experienced_pandit_image">
                            <label class="form-check-label" for="delete_experienced_pandit_image">Delete current
                                image</label>
                        </div>
                    @endif

                    <input type="file" name="experienced_pandit_image" class="form-control mt-2">
                </div>



                @for ($i = 1; $i <= 3; $i++)
                    <div class="mb-3">
                        <label for="slider_image_{{ $i }}" class="form-label">Slider Image
                            {{ $i }}</label><br>
                        @if (!empty($setting->{'slider_image_' . $i}))
                            <img src="{{ asset($setting->{'slider_image_' . $i}) }}" height="100" class="mb-2">
                        @endif
                        <input type="file" name="slider_image_{{ $i }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="slider_heading_{{ $i }}" class="form-label">Slider Heading
                            {{ $i }}</label>
                        <input type="text" class="form-control" name="slider_heading_{{ $i }}"
                            value="{{ old("slider_heading_$i", $setting->{'slider_heading_' . $i}) }}">
                    </div>

                    <div class="mb-3">
                        <label for="slider_subheading_{{ $i }}" class="form-label">Slider Subheading
                            {{ $i }}</label>
                        <textarea class="form-control" name="slider_subheading_{{ $i }}">{{ old("slider_subheading_$i", $setting->{'slider_subheading_' . $i}) }}</textarea>
                    </div>
                @endfor

            </div>
            <button class="btn btn-primary w-100">Save Settings</button>
        </form>
    </div>
@endsection
