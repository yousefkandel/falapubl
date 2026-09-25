@extends('admin.layouts.app')

@section('title', 'رسالة من ' . $message->name)
@section('page-title', 'تفاصيل الرسالة')
@section('breadcrumb', 'لوحة التحكم / رسائل التواصل / ' . $message->name)

@section('content')

<div class="panel">
    <div class="panel-header">
        <h3>الرسالة</h3>
        <div class="panel-actions">
            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-ghost btn-sm">رجوع للقائمة</a>
        </div>
    </div>

    <div style="padding: 28px;">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">الاسم</label>
                    <div class="form-control" style="background:rgba(255,255,255,.03);">{{ $message->name }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <div class="form-control" style="background:rgba(255,255,255,.03);" dir="ltr">
                        <a href="mailto:{{ $message->email }}" style="color:inherit;">{{ $message->email }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">الموضوع</label>
            <div class="form-control" style="background:rgba(255,255,255,.03);">{{ $message->subject ?: '— بدون موضوع —' }}</div>
        </div>

        <div class="form-group">
            <label class="form-label">نص الرسالة</label>
            <div class="form-control" style="background:rgba(255,255,255,.03); min-height:160px; white-space:pre-wrap; line-height:1.8;">{{ $message->message }}</div>
        </div>

        <div class="form-group">
            <label class="form-label">تاريخ الإرسال</label>
            <div class="form-control" style="background:rgba(255,255,255,.03);">{{ $message->created_at->format('Y-m-d H:i') }}</div>
        </div>

        <div class="modal-actions" style="justify-content:flex-start;">
            <a href="mailto:{{ $message->email }}" class="btn btn-gold">الرد عبر البريد</a>
            <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-ghost" style="color:#d9707a;">حذف الرسالة</button>
            </form>
        </div>
    </div>
</div>

@endsection
