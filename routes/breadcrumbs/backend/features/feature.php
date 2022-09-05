<?php

Breadcrumbs::for('admin.features.index', function ($trail) {
    $trail->push(__('labels.backend.access.features.management'), route('admin.features.index'));
});

Breadcrumbs::for('admin.features.create', function ($trail) {
    $trail->parent('admin.features.index');
    $trail->push(__('labels.backend.access.features.management'), route('admin.features.create'));
});

Breadcrumbs::for('admin.features.edit', function ($trail, $id) {
    $trail->parent('admin.features.index');
    $trail->push(__('labels.backend.access.features.management'), route('admin.features.edit', $id));
});
