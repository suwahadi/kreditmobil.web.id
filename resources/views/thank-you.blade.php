@extends('layouts.app')

@push('meta')
    <title>Terima Kasih - {{ config('app.name') }}</title>
    <meta name="title" content="Terima Kasih - {{ config('app.name') }}">
    <meta name="description" content="Permintaan Anda telah berhasil diverifikasi. Kami akan segera menghubungi Anda.">
    <meta property="og:title" content="Terima Kasih - {{ config('app.name') }}">
    <meta property="og:description" content="Permintaan Anda telah berhasil diverifikasi. Kami akan segera menghubungi Anda.">
@endpush

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-12" style="font-family: 'Poppins', sans-serif;">
        <div class="min-h-[60vh] flex items-center justify-center">
            <div class="w-full max-w-xl bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
                <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-green-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-green-600">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900 leading-tight mb-2">Terima kasih</h1>
                <p class="text-sm md:text-base text-slate-600">Permintaan Anda telah berhasil diverifikasi. Tim kami akan segera menghubungi Anda.</p>
                <a href="/" class="inline-block mt-6 px-5 py-2.5 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors font-medium">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
@endsection
