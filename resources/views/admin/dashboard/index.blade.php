@extends('admin.layouts.app')

@section('title', 'الرئيسية')
@section('page-title')
    مرحباً، {{ auth()->user()->name ?? 'مدير المكتبة' }}
@endsection
@section('breadcrumb', 'لوحة التحكم')

@section('content')

<div class="stats-grid">

    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 5a2 2 0 012-2h11v18H6a2 2 0 01-2-2V5z"/><path d="M17 3v18"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_books'] }}</div>
        <div class="stat-label">إجمالي الكتب</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['active_books'] }}</div>
        <div class="stat-label">كتب منشورة</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(212,175,90,.3); --stat-icon-bg: rgba(212,175,90,.15); --stat-icon-color: #e8cd8a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_authors'] }}</div>
        <div class="stat-label">المؤلفون</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 4l8 4-8 4M8 12l8 4-8 4"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_translators'] }}</div>
        <div class="stat-label">المترجمون</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-label">المستخدمون</div>
    </div>

</div>

<div class="row">
    <div class="col-8">
        <div class="panel">
            <div class="panel-header">
                <h3>أحدث الكتب المضافة</h3>
                <div class="panel-actions">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-ghost btn-sm">عرض الكل</a>
                </div>
            </div>
            <div class="table-wrap">
                <table class="falak-table">
                    <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>المؤلف</th>
                            <th>سنة النشر</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBooks as $book)
                            <tr>
                                <td><strong>{{ $book->title_ar }}</strong></td>
                                <td>{{ $book->author->name_ar ?? '—' }}</td>
                                <td>{{ $book->publication_year ?? '—' }}</td>
                                <td>
                                    @if($book->status)
                                        <span class="badge badge-success">منشور</span>
                                    @else
                                        <span class="badge badge-danger">غير منشور</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">لا توجد كتب بعد</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="panel">
            <div class="panel-header">
                <h3>أحدث المستخدمين</h3>
                <div class="panel-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">عرض الكل</a>
                </div>
            </div>
            <div style="padding: 8px 20px 20px;">
                @forelse($latestUsers as $user)
                    <div class="sidebar-user" style="padding: 10px 0; border-bottom: 1px solid rgba(201,160,99,.12);">
                        <div class="avatar">{{ mb_substr($user->name, 0, 1) }}</div>
                        <div>
                            <div class="name">{{ $user->name }}</div>
                            <div class="role">{{ $user->email }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">لا يوجد مستخدمون بعد</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
