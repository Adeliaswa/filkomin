<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\DistributionSetting;
use Illuminate\Http\Request;

class DistributionSettingsController extends Controller
{
    public function edit()
    {
        $settings = DistributionSetting::firstOrCreate([]);
        return view('admin.system.distribution', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = DistributionSetting::firstOrCreate([]);

        $data = $request->validate([
            'email_enabled' => 'nullable',
            'pdf_download_enabled' => 'nullable',
            'whatsapp_enabled' => 'nullable',
            'default_template_key' => 'nullable|string|max:100',
            'file_naming_pattern' => 'required|string|max:255',
        ]);

        // checkbox -> boolean
        $data['email_enabled'] = $request->boolean('email_enabled');
        $data['pdf_download_enabled'] = $request->boolean('pdf_download_enabled');
        $data['whatsapp_enabled'] = $request->boolean('whatsapp_enabled');

        $settings->update($data);

        activity_log('UPDATE', 'DistributionSetting', $settings->id, 'Updated distribution settings');

        return back()->with('success', 'Distribution settings updated.');
    }
}
