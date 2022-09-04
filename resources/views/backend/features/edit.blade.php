@extends('backend.layouts.app')

@section('title', __('labels.backend.access.features.management') . ' | ' . __('labels.backend.access.features.edit'))

@section('breadcrumb-links')
@include('backend.features.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($feature, ['route' => ['admin.features.update', $feature], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    @include('backend.features.form')
    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.features.index', 'id' => $feature->id ])
</div>
<!--card-->
{{ Form::close() }}
@endsection