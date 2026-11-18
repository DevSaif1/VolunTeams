@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                    <span class="text-xs font-bold tracking-[0.18em] uppercase text-indigo-600">
                        VolunTeams
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-950">
                    إنشاء حساب أو مسؤول جديد
                </h1>
                <p class="mt-2 text-sm sm:text-base text-slate-500">
                    قم بإدخال بيانات الحساب وتحديد الدور الصلاحي المناسب له في المنصة.
                </p>
            </div>

            <a href="{{ route('users.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-indigo-50">
                العودة للقائمة
            </a>
        </div>

        {{-- Main Card --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_8px_30px_rgba(15,23,42,0.05)] p-6 sm:p-8">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-800">اسم المستخدم <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @error
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800">البريد الإلكتروني <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @error
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800">كلمة المرور المؤقتة أو الدائمة <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required
                           class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @error
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800">الدور وصلاحيات النظام <span class="text-red-500">*</span></label>
                    <select name="role" required
                            class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10">
                        <option value="" disabled selected>اختر الدور المناسب...</option>
                        @foreach($roles as $r)
                            <option value="{{ $r }}">{{ $r }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @error
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('users.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700">إلغاء</a>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-sm font-bold text-white hover:bg-indigo-700">حفظ وإنشاء الحساب</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection