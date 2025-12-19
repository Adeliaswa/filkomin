<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributionSetting extends Model
{
    protected $fillable = [
        'email_enabled','whatsapp_enabled','pdf_enabled','public_link_enabled',
        'email_from_name','email_from_address','email_subject_default',
        'wa_sender_name','wa_gateway_provider','wa_gateway_config',
        'reminder_enabled','reminder_days_before','updated_by',
    ];

    protected $casts = [
        'email_enabled' => 'boolean',
        'whatsapp_enabled' => 'boolean',
        'pdf_enabled' => 'boolean',
        'public_link_enabled' => 'boolean',
        'reminder_enabled' => 'boolean',
    ];
}
