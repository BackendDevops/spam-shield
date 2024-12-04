
@if(config('antispam.honeypot.enabled'))
    <input type="text" name="{{ config('antispam.honeypot.field_name') }}" style="display:none;">
@endif
