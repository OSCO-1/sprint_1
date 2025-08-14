<?php

namespace App\Http\Controllers\pkg_Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Menu\StoreMenuItemRequest;
use App\Http\Requests\pkg_Menu\UpdateMenuItemRequest;
use App\Repositories\pkg_Menu\MenuItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    protected MenuItemRepository $itemRepo;

    public function __construct(MenuItemRepository $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    /**
     * Get all menu items, optionally filtered by restaurant or category.
     */
    public function index(Request $request): JsonResponse
    {
        $items = $this->itemRepo->getAll();

        // Optional filtering
        if ($request->has('restaurant_id')) {
            $items = $items->where('restaurant_id', $request->restaurant_id);
        }
        if ($request->has('menu_category_id')) {
            $items = $items->where('menu_category_id', $request->menu_category_id);
        }

        return response()->json($items);
    }

    /**
     * Show a single menu item by ID.
     */
    public function show(int $id): JsonResponse
    {
        $item = $this->itemRepo->getById($id);

        if (!$item) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        return response()->json($item);
    }

    /**
     * Create a new menu item.
     */
    public function store(StoreMenuItemRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url');
        }

        $item = $this->itemRepo->createItem($validated);

        return response()->json($item, 201);
    }

    /**
     * Update an existing menu item.
     */
    public function update(UpdateMenuItemRequest $request, int $id): JsonResponse
    {
        // Debug: Log all incoming request data
        \Log::info('Update request received', [
            'id' => $id,
            'all_data' => $request->all(),
            'method' => $request->method(),
            'has_files' => $request->hasFile('image_url')
        ]);

        $validated = $request->validated();
        
        \Log::info('Validated data', ['validated' => $validated]);

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url');
        }

        $item = $this->itemRepo->updateItem($id, $validated);

        if (!$item) {
            \Log::error('Menu item not found for update', ['id' => $id]);
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        \Log::info('Menu item updated successfully', [
            'id' => $id,
            'updated_item' => $item->toArray()
        ]);

        return response()->json($item);
    }

    /**
     * Delete a menu item.
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->itemRepo->deleteItem($id);

        if (!$deleted) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        return response()->json(['message' => 'Menu item deleted successfully']);
    }

    /**
     * Filter menu items by category ID.
     */
    public function filterByCategory(int $categoryId): JsonResponse
    {
        $items = $this->itemRepo->getAll()->where('menu_category_id', $categoryId);
        return response()->json(['data' => $items]);
    }
}
