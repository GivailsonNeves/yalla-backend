<?php

namespace App\Http\Controllers\Backend\Features;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Features\CreateFeaturesRequest;
use App\Http\Requests\Backend\Features\DeleteFeaturesRequest;
use App\Http\Requests\Backend\Features\ManageFeaturesRequest;
use App\Http\Requests\Backend\Features\StoreFeaturesRequest;
use App\Http\Requests\Backend\Features\UpdateFeaturesRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Feature;
use App\Repositories\Backend\FeaturesRepository;
use Illuminate\Support\Facades\View;

class FeaturesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\FeaturesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\FeaturesRepository $feature
     */
    public function __construct(FeaturesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['features']);
    }

    /**
     * @param \App\Http\Requests\Backend\Features\ManageFaqsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageFeaturesRequest $request)
    {
        return new ViewResponse('backend.features.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Features\CreateFaqsRequest $request
     *
     * @return ViewResponse
     */
    public function create(CreateFeaturesRequest $request)
    {
        return new ViewResponse('backend.features.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Features\StoreFaqsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreFeaturesRequest $request)
    {
        $this->repository->create($request->except('_token'));

        return new RedirectResponse(route('admin.features.index'), ['flash_success' => __('alerts.backend.features.created')]);
    }

    /**
     * @param \App\Models\Feature $feature
     * @param \App\Http\Requests\Backend\Features\ManagePageRequest $request
     *
     * @return ViewResponse
     */
    public function edit(Feature $feature, ManageFeaturesRequest $request)
    {
        return new ViewResponse('backend.features.edit', ['feature' => $feature]);
    }

    /**
     * @param \App\Models\Feature $feature
     * @param \App\Http\Requests\Backend\Features\UpdateFeaturesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Feature $feature, UpdateFeaturesRequest $request)
    {
        $this->repository->update($feature, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.features.index'), ['flash_success' => __('alerts.backend.features.updated')]);
    }

    /**
     * @param \App\Models\Feature $feature
     * @param \App\Http\Requests\Backend\Pages\DeleteFeaturesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Feature $feature, DeleteFeaturesRequest $request)
    {
        $this->repository->delete($feature);

        return new RedirectResponse(route('admin.features.index'), ['flash_success' => __('alerts.backend.features.deleted')]);
    }
}
