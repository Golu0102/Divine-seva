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
            $setting = new \App\Models\SiteSetting(); // empty object bhejo
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
        ]);

        $setting = SiteSetting::first();

        if (!$setting) {
            $setting = new SiteSetting();
        }

        // ✅ Handle logo upload
        if ($request->hasFile('logo')) {
            $filename = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads/logo'), $filename);
            $setting->logo = 'uploads/logo/' . $filename;
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

        // ✅ Save settings
        $setting->save();

        return back()->with('success', 'Settings updated!');
    }
}
