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

        // Keep UploadedFile instance for repository
        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url');
        }

        $category = $this->categoryRepo->createCategory($validated);

        return response()->json($category, 201);
    }


    /**
     * Update a category.
     */
    public function update(UpdateMenuCategoryRequest $request, int $id): JsonResponse
    {
        // Debug: Log all incoming request data
        \Log::info('Category update request received', [
            'id' => $id,
            'all_data' => $request->all(),
            'method' => $request->method(),
            'has_files' => $request->hasFile('image_url')
        ]);

        $validated = $request->validated();
        
        \Log::info('Category validated data', ['validated' => $validated]);

        $category = $this->categoryRepo->updateCategory($id, $validated);

        if (!$category) {
            \Log::error('Category not found for update', ['id' => $id]);
            return response()->json(['message' => 'Category not found'], 404);
        }

        \Log::info('Category updated successfully', [
            'id' => $id,
            'updated_category' => $category->toArray()
        ]);

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
    public function reorder(Request $request): JsonResponse
    {
        try {
            \Log::info('Reorder request received', [
                'request_data' => $request->all(),
                'method' => $request->method()
            ]);

            // Simple validation without form request
            $orderedIds = $request->input('ordered_ids', []);
            
            if (empty($orderedIds) || !is_array($orderedIds)) {
                \Log::error('Invalid ordered_ids parameter', ['ordered_ids' => $orderedIds]);
                return response()->json(['message' => 'Invalid ordered_ids parameter'], 400);
            }

            // Validate all IDs are integers
            foreach ($orderedIds as $id) {
                if (!is_numeric($id)) {
                    \Log::error('Non-numeric ID found', ['id' => $id]);
                    return response()->json(['message' => 'All IDs must be numeric'], 400);
                }
            }

            // Convert to integers
            $orderedIds = array_map('intval', $orderedIds);

            \Log::info('Using repository reorder method', ['ordered_ids' => $orderedIds]);

            // Use the repository method for proper error handling and transaction support
            $this->categoryRepo->reorder($orderedIds);

            \Log::info('Categories reordered successfully');

            return response()->json(['message' => 'Categories reordered successfully']);
        } catch (\Exception $e) {
            \Log::error('Reorder failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'message' => 'Failed to reorder categories',
                'error' => $e->getMessage(),
                'debug' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }
}
