@extends('frontend.layouts.app')

@section('title', 'Desain Interior Premium')

@section('content')
{{-- Hero Section --}}
@include('frontend.partials.hero')

{{-- Statistics Section --}}
@include('frontend.partials.statistics')

{{-- Portfolio Section --}}
@include('frontend.partials.portfolio')

{{-- Services Section --}}
@include('frontend.partials.services')

{{-- Calculator Section --}}
@include('frontend.partials.calculator')

{{-- Testimonials Section --}}
@include('frontend.partials.testimonials')

{{-- Contact Section --}}
@include('frontend.partials.contact')
@endsection