<div class="lang-switch" aria-label="{{ __('messages.language') }}">
    <a href="{{ route('site.language.switch', ['locale' => 'ar']) }}" hreflang="ar" lang="ar" @if(app()->isLocale('ar')) aria-current="page" @endif>النسخة العربية</a>
    <span aria-hidden="true">|</span>
    <a href="{{ route('site.language.switch', ['locale' => 'en']) }}" hreflang="en" lang="en" @if(app()->isLocale('en')) aria-current="page" @endif>English version</a>
</div>
