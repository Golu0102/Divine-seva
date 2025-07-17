<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SiteSettingsController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::first();

        if (!$setting) {
            $setting = new SiteSetting(); // empty object bhejo
        }

        return view('superadmin.site-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'footer_text' => 'nullable|string',
            'email' => 'nullable|email',
            'site_name' => 'nullable|string|max:255',
            'blog_1' => 'nullable|string|max:500',
            'blog_2' => 'nullable|string|max:500',
            'blog_3' => 'nullable|string|max:500',
            'blog_4' => 'nullable|string|max:500',
            'blog_5' => 'nullable|string|max:500',
            'blog_6' => 'nullable|string|max:500',
            'blog_7' => 'nullable|string|max:500',
            'delete_logo' => 'nullable|boolean',
            '*.slider_image_1' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            '*.slider_image_2' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            '*.slider_image_3' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'experienced_pandit_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'delete_experienced_pandit_image' => 'nullable|boolean',


        ]);

        $setting = SiteSetting::first();

        if (!$setting) {
            $setting = new SiteSetting();
        }

        // ✅ Delete logo if checkbox checked
        if ($request->delete_logo && $setting->logo) {
            $logoPath = public_path($setting->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
            $setting->logo = null;
        }

        // ✅ Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo first
            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            $filename = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/logo'), $filename);
            $setting->logo = 'uploads/logo/' . $filename;
        }

        foreach ([1, 2, 3] as $i) {
            if ($request->hasFile("slider_image_$i")) {
                $file = $request->file("slider_image_$i");
                $filename = time() . "_slider_$i." . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/slider'), $filename);
                $setting->{"slider_image_$i"} = "uploads/slider/" . $filename;
            }

            $setting->{"slider_heading_$i"} = $request->input("slider_heading_$i");
            $setting->{"slider_subheading_$i"} = $request->input("slider_subheading_$i");
        }

        // ✅ Delete experienced pandit image
        if ($request->delete_experienced_pandit_image && $setting->experienced_pandit_image) {
            $oldPath = public_path($setting->experienced_pandit_image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            $setting->experienced_pandit_image = null;
        }

        // ✅ Upload experienced pandit image
        if ($request->hasFile('experienced_pandit_image')) {
            if ($setting->experienced_pandit_image && file_exists(public_path($setting->experienced_pandit_image))) {
                unlink(public_path($setting->experienced_pandit_image));
            }

            $filename = time() . '_experienced_pandit.' . $request->experienced_pandit_image->extension();
            $request->experienced_pandit_image->move(public_path('uploads/pandit'), $filename);
            $setting->experienced_pandit_image = 'uploads/pandit/' . $filename;
        }


        // ✅ Set other fields
        $setting->site_name = $request->site_name;
        $setting->footer_text = $request->footer_text;
        $setting->address = $request->address;
        $setting->email = $request->email;
        $setting->mobile = $request->mobile;
        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->twitter = $request->twitter;
        $setting->youtube = $request->youtube;
        $setting->blog_1 = $request->blog_1;
        $setting->blog_2 = $request->blog_2;
        $setting->blog_3 = $request->blog_3;
        $setting->blog_4 = $request->blog_4;
        $setting->blog_5 = $request->blog_5;
        $setting->blog_6 = $request->blog_6;
        $setting->blog_7 = $request->blog_7;

        $setting->save();

        return back()->with('success', 'Settings updated!');
    }
}
