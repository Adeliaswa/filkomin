<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = SystemSetting::firstOrCreate([]);
        return view('admin.system.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SystemSetting::firstOrCreate([]);

        $data = $request->validate([
            'app_name' => 'required|string|max:255',
            'timezone' => 'required|string|max:64',
            'default_language' => 'required|string|max:10',
            'theme_color' => 'nullable|string|max:20',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo_path'] = $path;
        }

        unset($data['logo']);

        $settings->update($data);

        activity_log('UPDATE', 'SystemSetting', $settings->id, 'Updated system settings');

        return back()->with('success', 'System settings updated.');
    }
}
