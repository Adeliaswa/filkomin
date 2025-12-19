<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;

class TemplateController extends Controller
{
    // 1️⃣ LIST TEMPLATE
    public function index()
    {
        $templates = Template::orderBy('id')->get();
        return view('admin.templates.index', compact('templates'));
    }

    // 2️⃣ AKTIF / NONAKTIF
    public function toggle(Template $template)
    {
        $template->update([
            'is_active' => !$template->is_active
        ]);

        return back()->with('success', 'Template status updated');
    }

    // 3️⃣ PREVIEW TEMPLATE (DUMMY DATA)
    public function preview(Template $template)
    {
        if (!view()->exists($template->path)) {
            abort(404, 'Template view not found');
        }

        // dummy event (SESUAI FIELD ASLI)
        $event = (object) [
            'title' => 'Preview Event Title',
            'category' => $template->category,
            'date' => now()->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '11:00',
            'location_type' => 'onsite',
            'location' => 'Aula FILKOM',
            'meeting_link' => null,
            'dress_code' => 'Formal',
            'organizer_name' => 'FILKOMIN',
            'organizer_unit' => 'Universitas',
            'notes' => 'Ini hanya preview admin',
        ];

        // dummy guest (UNTUK SEMI FORMAL & SPEAKER)
        $guest = (object) [
            'name' => 'Nama Tamu Preview',
            'invitation_token' => 'preview-token',
            'attendance_token' => 'preview-attendance',
        ];

        return view($template->path, compact('event', 'guest'));
    }
}
