@extends('backend.layouts.app')

@section('title', __('labels.backend.access.categories.management') . ' | ' . __('labels.backend.access.categories.create'))

@section('breadcrumb-links')
@include('backend.categories.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.categories.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    @include('backend.categories.form')
    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.categories.index' ])
</div>
<!--card-->
{{ Form::close() }}
@endsection