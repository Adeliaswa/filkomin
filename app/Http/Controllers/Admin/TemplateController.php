<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;

class TemplateController extends Controller
{
    /**
     * 1️⃣ LIST SEMUA TEMPLATE
     */
    public function index()
    {
        // ambil semua template (admin boleh lihat semua)
        $templates = Template::orderBy('id')->get();

        return view('admin.templates.index', compact('templates'));
    }

    /**
     * 2️⃣ APPROVE / DECLINE TEMPLATE
     */
    public function toggle(Template $template)
    {
        // toggle status aktif / nonaktif
        $template->update([
            'is_active' => !$template->is_active
        ]);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template status updated');
    }

    /**
     * 3️⃣ PREVIEW TEMPLATE (PAKAI DUMMY EVENT)
     */
    public function preview(Template $template)
    {
        // pastikan file blade template ada
        if (!view()->exists($template->path)) {
            abort(404, 'Template view not found');
        }

        /**

         */
        $event = (object) [
            'title'       => 'Sample Official Event',
            'event_time'  => 'Monday, 20 January 2025 - 09:00',
            'location'    => 'Main Hall, Faculty of Computer Science',
            'dresscode'   => 'Formal Attire', // 
            'organizer'   => 'Faculty of Computer Science',
            'description' => 'This is a preview of the invitation template.',
            'token'       => 'preview'
        ];

        // render template blade pakai dummy event
        return view($template->path, compact('event'));
    }
}
