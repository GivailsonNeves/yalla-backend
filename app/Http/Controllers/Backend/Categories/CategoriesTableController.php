<?php

namespace App\Http\Controllers\Backend\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Categories\ManageCategoriesRequest;
use App\Repositories\Backend\CategoriesRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CategoriesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\CategoriesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\CategoriesRepository $categories
     */
    public function __construct(CategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Categories\ManageCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCategoriesRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->editColumn('created_at', function ($categories) {
                return Carbon::parse($categories->created_at)->toDateString();
            })
            ->addColumn('actions', function ($categories) {
                return $categories->action_buttons;
            })
            ->make(true);
    }
}
