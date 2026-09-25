@extends('admin.layouts.app')

@section('title', 'رسائل التواصل')
@section('page-title', 'رسائل التواصل')
@section('breadcrumb', 'لوحة التحكم / رسائل التواصل')

@section('content')

@if(session('success'))
    <div class="alert alert-success" style="background:rgba(111,191,139,.15); border:1px solid rgba(111,191,139,.4); color:#6fbf8b; padding:12px 18px; border-radius:10px; margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<div class="stats-grid">
    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $total_messages }}</div>
        <div class="stat-label">إجمالي الرسائل</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v5"/><circle cx="12" cy="16" r="0.6" fill="currentColor"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $unread_messages }}</div>
        <div class="stat-label">رسائل غير مقروءة</div>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <h3>كل الرسائل <span>({{ $messages->total() }} رسالة)</span></h3>
    </div>

    <div class="table-wrap">
        <table class="falak-table">
            <thead>
                <tr>
                    <th></th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الموضوع</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr style="{{ $message->is_read ? '' : 'font-weight:700;' }}">
                        <td>
                            @if(!$message->is_read)
                                <span class="badge badge-danger" style="padding:3px 8px;">جديد</span>
                            @else
                                <span class="badge" style="background:rgba(255,255,255,.08); color:rgba(248,245,240,.6);">مقروءة</span>
                            @endif
                        </td>
                        <td>{{ $message->name }}</td>
                        <td dir="ltr">{{ $message->email }}</td>
                        <td>{{ $message->subject ?: '—' }}</td>
                        <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="icon-btn" title="عرض الرسالة">👁️</a>
                                <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger" title="حذف">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">لا توجد رسائل بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $messages->links() }}</div>
</div>

@endsection
