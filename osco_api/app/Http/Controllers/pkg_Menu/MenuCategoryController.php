<?php

namespace App\Http\Controllers\pkg_Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Menu\ReorderMenuCategoryRequest;
use App\Http\Requests\pkg_Menu\StoreMenuCategoryRequest;
use App\Http\Requests\pkg_Menu\UpdateMenuCategoryRequest;
use App\Models\pkg_Menu\MenuCategory;
use App\Repositories\pkg_Menu\MenuCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MenuCategoryController extends Controller
{
    protected MenuCategoryRepository $categoryRepo;

    public function __construct(MenuCategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Get all categories for a given restaurant.
     */
    public function index()
    {
        return response()->json($this->categoryRepo->getAll());
    }


    public function show(int $id): JsonResponse
    {
        $category = $this->categoryRepo->getById($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    /**
     * Create a new category.
     */
    public function store(StoreMenuCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Use repository to create category (assuming you have createCategory method)
        $category = $this->categoryRepo->createCategory($validated);

        return response()->json($category, 201);
    }

    /**
     * Update a category.
     */
    public function update(UpdateMenuCategoryRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $category = $this->categoryRepo->updateCategory($id, $validated);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }


    /**
     * Delete a category.
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->categoryRepo->deleteCategory($id);

        if (!$deleted) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['message' => 'Category deleted successfully']);
    }

    /**
     * Reorder categories.
     */
    public function reorder(ReorderMenuCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        // dd('$request->all()');
        $validated = $request->validated();

        $this->categoryRepo->reorder($validated['ordered_ids']);

        return response()->json(['message' => 'Categories reordered successfully']);
    }
}
