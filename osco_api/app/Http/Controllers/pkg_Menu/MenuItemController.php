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
            // dd($request->all());
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url');
        }

        $item = $this->itemRepo->updateItem($id, $validated);

        if (!$item) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

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
}
