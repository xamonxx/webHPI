@extends('frontend.layouts.app')

@php
    $siteName = $settings['site_name'] ?? 'Home Putra Interior';
    $homeTitle = $settings['seo_meta_title'] ?? $siteName;
    $homeDescription = $settings['seo_meta_description'] ?? ($settings['site_description'] ?? '');
@endphp

@section('title', $homeTitle)
@section('meta_title', $homeTitle)
@section('meta_description', $homeDescription)
@section('og_title', $homeTitle)
@section('og_description', $homeDescription)
@section('twitter_title', $homeTitle)
@section('twitter_description', $homeDescription)

@section('content')
{{-- Hero Section --}}
@include('frontend.partials.hero')

{{-- Statistics Section --}}
@include('frontend.partials.statistics')

{{-- Portfolio Section --}}
@include('frontend.partials.portfolio')

{{-- Services Section --}}
@include('frontend.partials.services')

{{-- Testimonials Section --}}
@include('frontend.partials.testimonials')

{{-- Contact Section --}}
@include('frontend.partials.contact')
@endsection
