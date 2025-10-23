@extends('components.layouts.legal')

@section('content')
@php
    $impressumContent = \App\Models\Setting::get('impressum_content');
@endphp

<div class="max-w-4xl mx-auto px-6 py-12 lg:py-16">
    <div class="animate-fade-in">
        <x-ui.heading level="1" class="mb-8 ltr:text-left rtl:text-right">{{ __('Impressum') }}</x-ui.heading>

        <div class="prose prose-slate prose-lg max-w-none ltr:prose rtl:prose-rtl">
            {!! $impressumContent !!}
        </div>
    </div>
</div>
@endsection
