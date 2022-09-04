<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Features\FeatureCreated;
use App\Events\Backend\Features\FeatureDeleted;
use App\Events\Backend\Features\FeatureUpdated;
use App\Exceptions\GeneralException;
use App\Models\Feature;
use App\Repositories\BaseRepository;

class FeaturesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Feature::class;

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

        if ($feature = Feature::create($input)) {
            event(new FeatureCreated($feature));

            return $feature;
        }

        throw new GeneralException(__('exceptions.backend.faqs.create_error'));
    }

    /**
     * @param \App\Models\Feature $feature
     * @param array $input
     */
    public function update(Feature $feature, array $input)
    {
        $input['updated_by'] = auth()->user()->id;
        $input['status'] = $input['status'] ?? 0;

        if ($feature->update($input)) {
            event(new FeatureUpdated($feature));

            return $feature->fresh();
        }

        throw new GeneralException(__('exceptions.backend.features.update_error'));
    }

    /**
     * @param \App\Models\Feature $feature
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Feature $feature)
    {
        if ($feature->delete()) {
            event(new FeatureDeleted($feature));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.faqs.delete_error'));
    }
}
