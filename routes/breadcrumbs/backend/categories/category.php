<?php

Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->push(__('labels.backend.access.categories.management'), route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.categories.index');
    $trail->push(__('labels.backend.access.categories.management'), route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.edit', function ($trail, $id) {
    $trail->parent('admin.categories.index');
    $trail->push(__('labels.backend.access.categories.management'), route('admin.categories.edit', $id));
});
