<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequest;
use App\Repository\Category\CategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show all category
     *
     * @return Application|ResponseFactory|Response
     */
    public function getAllCategory(): Application|ResponseFactory|Response
    {
        $allCategories = $this->categoryRepository->getAllCategory();

        return response(CategoryResource::collection($allCategories));
    }

    /**
     * Show add new category
     *
     * @param CategoryRequest $request
     * @return Application|Response|ResponseFactory
     */
    public function store(CategoryRequest $request): Application|ResponseFactory|Response
    {
        $storeCategories = $this->categoryRepository->store($request->name);

        return response(new CategoryResource($storeCategories));
    }

    /**
     * Category update
     *
     * @param CategoryRequest $request
     * @param $id
     * @return Application|Response|ResponseFactory
     */
    public function update(CategoryRequest $request, $id): Application|ResponseFactory|Response
    {
        $updateCategories = $this->categoryRepository->update(
            $request->name,
            $id
        );
        return response(new CategoryRequest((array)$updateCategories));
    }

    /**
     * Show one category
     *
     * @param $id
     * @return Application|Response|ResponseFactory
     */
    public function show($id): Application|ResponseFactory|Response
    {
        $showCategories = $this->categoryRepository->show($id);

        return response(new CategoryRequest($showCategories));
    }

    /**
     * Delete category
     *
     * @param $id
     * @return JsonResponse
     */
    public function delete($id)
    {
       $this->categoryRepository->delete($id);

       return response()->json(201);

    }


}
