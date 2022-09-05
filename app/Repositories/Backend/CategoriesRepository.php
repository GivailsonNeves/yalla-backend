<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Categories\CategoryCreated;
use App\Events\Backend\Categories\CategoryDeleted;
use App\Events\Backend\Categories\CategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Category::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'id',
                'name',
                'created_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $input['created_by'] = auth()->user()->id;
        $input['status'] = $input['status'] ?? 0;

        if ($category = Category::create($input)) {
            event(new CategoryCreated($category));

            return $category;
        }

        throw new GeneralException(__('exceptions.backend.categories.create_error'));
    }

    /**
     * @param \App\Models\Category $category
     * @param array $input
     */
    public function update(Category $category, array $input)
    {
        $input['updated_by'] = auth()->user()->id;
        $input['status'] = $input['status'] ?? 0;

        if ($category->update($input)) {
            event(new CategoryUpdated($category));

            return $category->fresh();
        }

        throw new GeneralException(__('exceptions.backend.categories.update_error'));
    }

    /**
     * @param \App\Models\Category $category
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Category $category)
    {
        if ($category->delete()) {
            event(new CategoryDeleted($category));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.categories.delete_error'));
    }
}
