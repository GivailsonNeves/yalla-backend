<?php

namespace App\Http\Controllers\Backend\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\CreateCategoriesRequest;
use App\Http\Requests\Backend\Categories\DeleteCategoriesRequest;
use App\Http\Requests\Backend\Categories\ManageCategoriesRequest;
use App\Http\Requests\Backend\Categories\StoreCategoriesRequest;
use App\Http\Requests\Backend\Categories\UpdateCategoriesRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\category;
use App\Repositories\Backend\CategoriesRepository;
use Illuminate\Support\Facades\View;

class CategoriesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\CategoriesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\CategoriesRepository $category
     */
    public function __construct(CategoriesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['categories']);
    }

    /**
     * @param \App\Http\Requests\Backend\Categories\ManageCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageCategoriesRequest $request)
    {
        return new ViewResponse('backend.categories.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Categories\CreateCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function create(CreateCategoriesRequest $request)
    {
        return new ViewResponse('backend.categories.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Categories\StoreCategoriesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreCategoriesRequest $request)
    {
        $this->repository->create($request->except('_token'));

        return new RedirectResponse(route('admin.categories.index'), ['flash_success' => __('alerts.backend.categories.created')]);
    }

    /**
     * @param \App\Models\category $category
     * @param \App\Http\Requests\Backend\Categories\ManagePageRequest $request
     *
     * @return ViewResponse
     */
    public function edit(category $category, ManageCategoriesRequest $request)
    {
        return new ViewResponse('backend.categories.edit', ['category' => $category]);
    }

    /**
     * @param \App\Models\category $category
     * @param \App\Http\Requests\Backend\Categories\UpdateCategoriesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(category $category, UpdateCategoriesRequest $request)
    {
        $this->repository->update($category, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.categories.index'), ['flash_success' => __('alerts.backend.categories.updated')]);
    }

    /**
     * @param \App\Models\category $category
     * @param \App\Http\Requests\Backend\Pages\DeleteCategoriesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(category $category, DeleteCategoriesRequest $request)
    {
        $this->repository->delete($category);

        return new RedirectResponse(route('admin.categories.index'), ['flash_success' => __('alerts.backend.categories.deleted')]);
    }
}
