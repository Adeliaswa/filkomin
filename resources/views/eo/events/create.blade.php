@extends('layouts.eo')

@section('content')

<style>
  .page-title {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .form-card {
    background: #fff;
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,.05);
    max-width: 900px;
  }

  .section-title {
    font-size: 18px;
    font-weight: 700;
    color: #4f79ff;
    margin: 28px 0 12px;
    border-bottom: 2px solid #f1ede4;
    padding-bottom: 6px;
  }

  .form-group {
    margin-bottom: 18px;
  }

  .form-group label {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    display: block;
  }

  .form-group input,
  .form-group select,
  .form-group textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #ddd;
    font-size: 14px;
    background: #fff;
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .radio-group {
    display: flex;
    gap: 20px;
    margin-top: 6px;
  }

  .template-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 14px;
  }

  .template-card {
    border: 2px solid #ddd;
    border-radius: 14px;
    padding: 16px;
    text-align: center;
    cursor: pointer;
  }

  .template-card.active {
    border-color: #4f79ff;
    background: #f4f7ff;
  }

  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 30px;
  }

  .btn-draft {
    background: #eee;
    color: #333;
    border-radius: 999px;
    padding: 10px 20px;
    font-weight: 600;
  }

  .form-label {
  font-weight: 600;
  margin-bottom: 6px;
  display: block;
}

.location-options {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
}

.location-card {
  border: 2px solid #e5e5e5;
  border-radius: 14px;
  padding: 12px 14px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 500;
  background: #fff;
  transition: all .2s ease;
}

.location-card input {
  display: none;
}

.location-card:hover {
  border-color: #4f79ff;
}

.location-card input:checked + span {
  color: #4f79ff;
  font-weight: 600;
}

.location-card:has(input:checked) {
  border-color: #4f79ff;
  background: #f0f4ff;
}

</style>

<h1 class="page-title">Create New Event</h1>

<div class="form-card">
<form method="POST" action="{{ route('eo.events.store') }}" enctype="multipart/form-data">
@csrf

{{-- A. BASIC INFO --}}
<div class="section-title">A. Basic Event Info</div>

<div class="form-group">
  <label>Event Title *</label>
  <input type="text" name="title" required>
</div>
<div class="form-group">
  <label>Event Category *</label>
  <select name="category" required>
    <option value="">Select Category</option>
    <option value="formal">Formal</option>
    <option value="semi-formal">Semi Formal</option>
    <option value="speaker">Speaker</option>
  </select>
</div>



<div class="form-group">
  <label>Organizer Name *</label>
  <input type="text" name="organizer_name" required>
</div>

<div class="form-group">
  <label>Organizer Unit *</label>
  <select name="organizer_unit" required>
    <option value="">Select Unit</option>
    <option value="dosen">Dosen</option>
    <option value="dpm">DPM</option>
    <option value="poros">POROS</option>
    <option value="bcc">BCC</option>
    <option value="kepanitiaan">Kepanitiaan</option>
  </select>
</div>


<div class="form-group">
  <label>Description *</label>
  <textarea name="description" rows="4" required></textarea>
</div>


{{-- B. SCHEDULE --}}
<div class="section-title">B. Schedule & Location</div>

<div class="form-group">
  <label>Date *</label>
  <input type="date" name="date" required>
</div>

<div class="form-row">
  <div class="form-group">
    <label>Start Time *</label>
    <input type="time" name="start_time" required>
  </div>
  <div class="form-group">
    <label>End Time</label>
    <input type="time" name="end_time">
  </div>
</div>

<div class="form-group">
  <label class="form-label">Location Type *</label>

  <div class="location-options">
    <label class="location-card">
      <input type="radio" name="location_type" value="onsite" required>
      <span>On-site</span>
    </label>

    <label class="location-card">
      <input type="radio" name="location_type" value="online">
      <span>Online</span>
    </label>

    <label class="location-card">
      <input type="radio" name="location_type" value="hybrid">
      <span>Hybrid</span>
    </label>
  </div>
</div>
<div class="form-group" id="physical-location" style="display:none;">
  <label>Event Location *</label>
  <input type="text" name="location" placeholder="Gedung G FILKOM / Aula / dll">
</div>
<div class="form-group" id="online-location" style="display:none;">
  <label>Meeting Link *</label>
  <input type="url" name="meeting_link" placeholder="https://zoom.us/j/xxxx">
</div>



{{-- C. INVITATION --}}
<div class="section-title">C. Invitation Details</div>

<div class="form-group">
  <label>Dress Code</label>
  <input type="text" name="dress_code">
</div>

<div class="form-group">
  <label>Additional Notes</label>
  <textarea name="notes" rows="3"></textarea>
</div>



{{-- E. CONTACT --}}
<div class="section-title">E. Contact & Approval</div>

<div class="form-group">
  <label>PIC Name *</label>
  <input type="text" name="pic_name" required>
</div>

<div class="form-group">
  <label>PIC WhatsApp *</label>
  <input type="text" name="pic_whatsapp" required>
</div>

<div class="form-group">
  <label>PIC Email</label>
  <input type="email" name="pic_email">
</div>

<div class="form-group">
  <label>Request Notes to Admin</label>
  <textarea name="request_notes" rows="3"></textarea>
</div>
{{-- D. INVITATION DELIVERY --}}
<div class="section-title">D. Invitation Delivery</div>

<div class="form-group">
  <label class="form-label">Invitation Type *</label>

  <div class="location-options">
    <label class="location-card">
      <input type="radio" name="invitation_type" value="link" required>
      <span>Link Invitation</span>
    </label>

    <label class="location-card">
      <input type="radio" name="invitation_type" value="pdf">
      <span>PDF Invitation</span>
    </label>
  </div>
</div>

{{-- ACTION --}}
<div class="form-actions">
  <button type="submit" name="status" value="draft" class="btn-draft">
    Save as Draft
  </button>
  <button type="submit" name="status" value="pending" class="btn btn-primary">
    Submit for Approval
  </button>
</div>

</form>
<script>
  const locationRadios = document.querySelectorAll('input[name="location_type"]');
  const physicalField = document.getElementById('physical-location');
  const onlineField = document.getElementById('online-location');

  locationRadios.forEach(radio => {
    radio.addEventListener('change', function () {
      if (this.value === 'onsite') {
        physicalField.style.display = 'block';
        onlineField.style.display = 'none';
      }

      if (this.value === 'online') {
        physicalField.style.display = 'none';
        onlineField.style.display = 'block';
      }

      if (this.value === 'hybrid') {
        physicalField.style.display = 'block';
        onlineField.style.display = 'block';
      }
    });
  });
</script>

</div>

@endsection
