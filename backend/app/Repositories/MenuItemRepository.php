<?php
namespace App\Repositories;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Exception;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class MenuItemRepository extends BaseRepository
{
    public function __construct(){
        parent::__construct(new MenuItem());
    }


    public function getAllMenuItems()
    {
        Log::info('Fetching all menu items');
        try {
            $menuItems = MenuItem::with('menuCategory')->get();
            Log::info('Menu items fetched successfully', ['count' => $menuItems->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $menuItems
            ], 200);
        } catch (Exception $error) {
            Log::error( 'Error fetching menu items', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch menu items'
            ], 500);
        }
    }
    // filter by category
    public function getMenuItemsByCategory($categoryId)
    {
        Log::info('Fetching menu items by category', ['category_id' => $categoryId]);
        try {
            $menuItems = MenuItem::where('menu_category_id', $categoryId)->with('menuCategory')->get();
            Log::info('Menu items fetched successfully', ['count' => $menuItems->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $menuItems
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching menu items', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch menu items'
            ], 500);
        }
    }

    public function getMenuItemById($id)
    {
        Log::info('Fetching menu item by ID', ['id' => $id]);
        try {
            $menuItem = MenuItem::with('menuCategory')->findOrFail($id);
            Log::info('Menu item fetched successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $menuItem
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching menu item', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Menu item not found'
            ], 404);
        }
    }

    public function createMenuItem(array $data)
    {
        Log::info('Creating new menu item', ['data' => $data]);
        try {
            $menuItem = MenuItem::create($data);
            Log::info('Menu item created successfully', ['id' => $menuItem->id]);
            return response()->json([
                'status' => 'success',
                'data' => $menuItem
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating menu item', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create menu item'
            ], 500);
        }
    }

    public function updateMenuItem($id, array $data)
    {
        Log::info('Updating menu item', ['id' => $id, 'data' => $data]);
        try {
            $menuItem = MenuItem::findOrFail($id);
            $menuItem->update($data);
            Log::info('Menu item updated successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $menuItem
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating menu item', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update menu item'
            ], 500);
        }
    }

    public function deleteMenuItem($id)
    {
        Log::info('Deleting menu item', ['id' => $id]);
        try {
            $menuItem = MenuItem::findOrFail($id);
            $menuItem->delete();
            Log::info('Menu item deleted successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'message' => 'Menu item deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting menu item', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete menu item'
            ], 500);
        }
    }
}
