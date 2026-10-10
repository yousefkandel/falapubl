@extends('site.layout')

@php
    $isEnglish = app()->isLocale('en');
    $pageTitle = $isEnglish ? ($page?->title_en ?: $page?->title_ar ?: __('messages.contact')) : ($page?->title_ar ?: $page?->title_en ?: __('messages.contact'));
    $pageContent = $isEnglish ? ($page?->content_en ?: $page?->content_ar) : ($page?->content_ar ?: $page?->content_en);
    $pageAddress = $isEnglish ? ($page?->address_en ?: $page?->address_ar) : ($page?->address_ar ?: $page?->address_en);
@endphp

@section('title', $pageTitle . ' — ' . __('messages.brand_short'))
@section('meta_description', Str::limit($pageContent ?: __('messages.contact_details'), 160))

@section('content')

<section class="hero-cosmic" style="min-height: 240px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    @include('site.partials.orbit-field')

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1 dir="auto" style="font-size: clamp(26px,4vw,40px);">{{ $pageTitle }}</h1>
        @if($pageContent)
            <p dir="auto">{{ $pageContent }}</p>
        @endif
    </div>
</section>

<section class="fk-page-content">
    <div class="fk-contact-grid">

        <div class="fk-contact-info">
            <h3>{{ __('messages.contact_details') }}</h3>
            <ul>
                @if($page && $page->email)
                <li>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
                    <a href="mailto:{{ $page->email }}">{{ $page->email }}</a>
                </li>
                @endif
                @if($page && $page->phone)
                <li>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
                    <a href="tel:{{ preg_replace('/\s+/', '', $page->phone) }}" dir="ltr">{{ $page->phone }}</a>
                </li>
                @endif
                @if($pageAddress)
                <li>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 22s7-7.2 7-12.5A7 7 0 005 9.5C5 14.8 12 22 12 22z"/><circle cx="12" cy="9.5" r="2.3"/></svg>
                    <span dir="auto">{{ $pageAddress }}</span>
                </li>
                @endif
            </ul>
        </div>

        <div class="fk-contact-form-wrap">
            @if(session('success'))
                <div class="fk-alert fk-alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="fk-alert fk-alert-error">
                    <ul style="margin:0;padding-inline-start:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('site.contact.submit') }}" class="fk-contact-form">
                @csrf
                <div class="fk-form-row">
                    <label for="name">{{ __('messages.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="fk-form-row">
                    <label for="email">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="fk-form-row">
                    <label for="subject">{{ __('messages.subject') }} ({{ __('messages.optional') }})</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                </div>
                <div class="fk-form-row">
                    <label for="message">{{ __('messages.message') }}</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-primary">{{ __('messages.send_message') }}</button>
            </form>
        </div>
    </div>
</section>

@endsection
