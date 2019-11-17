<div class="form-group">
    <div class="g-recaptcha" data-sitekey="{{ env('re_public') }}"></div>
    @error('g-recaptcha-response')
    <span class="invalid-feedback" style="display: block">Please check the recaptch box</span>
    @enderror
</div>