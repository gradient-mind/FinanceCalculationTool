<?php

namespace App\Http\Controllers\Api\V1\Defaults;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Defaults\Categories\IndexCategoryRequest;
use App\Http\Requests\Api\V1\Defaults\Categories\ShowCategoryRequest;
use App\Http\Requests\Api\V1\Defaults\Categories\StoreCategoryRequest;
use App\Http\Requests\Api\V1\Defaults\Categories\UpdateCategoryRequest;
use App\Http\Resources\Api\V1\Defaults\CategoryCollection;
use App\Http\Resources\Api\V1\Defaults\CategoryResource;
use App\Models\Defaults\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexCategoryRequest $request
     * @return CategoryCollection
     */
    public function index(IndexCategoryRequest $request): CategoryCollection
    {
        $data = $request->validated();
        $query = Category::queryRequest($data);
        return new CategoryCollection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $data = $request->validated();
        return new CategoryResource(Category::create($data));
    }

    /**
     * Display the specified resource.
     *
     * @param ShowCategoryRequest $request
     * @param int $id
     * @return CategoryResource
     */
    public function show(ShowCategoryRequest $request, int $id): CategoryResource
    {
        $data = $request->validated();
        $category = Category::queryRequest($data)->find($id);
        if(!$category) abort(404);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, int $id): CategoryResource
    {
        $category = Category::find($id);

        if(!$category) abort(404);
        if($category->is_primary) abort(405);

        $category->update($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $category = Category::find($id);

        if(!$category) abort(404);
        if($category->is_primary) abort(405);

        Category::destroy($id);
        return response('category deleted', 204);
    }
}
