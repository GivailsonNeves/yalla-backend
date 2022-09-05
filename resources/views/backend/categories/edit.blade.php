@extends('backend.layouts.app')

@section('title', __('labels.backend.access.categories.management') . ' | ' . __('labels.backend.access.categories.edit'))

@section('breadcrumb-links')
@include('backend.categories.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($category, ['route' => ['admin.categories.update', $category], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    @include('backend.categories.form')
    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.categories.index', 'id' => $category->id ])
</div>
<!--card-->
{{ Form::close() }}
@endsection