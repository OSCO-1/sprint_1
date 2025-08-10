<?php
namespace App\Repositories;

use App\Models\MenuCategory;
use Exception;
use Illuminate\Support\Facades\Log;

class MenuCategoryRepository extends BaseRepository
{
    public function __construct(){
        parent::__construct(new MenuCategory());
    }


    public function getAllMenuCategory()
    {
        Log::info('Fetching all menu categories');
        try {
            $menuCategories = MenuCategory::with('menuItems')->get();
            Log::info('Menu categories fetched successfully', ['count' => $menuCategories->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $menuCategories
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching menu categories', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch menu categories'
            ], 500);
        }
    }

    public function getMenuCategoryById($id)
    {
        Log::info('Fetching menu category by ID', ['id' => $id]);
        try {
            $menuCategory = MenuCategory::with('menuItems')->findOrFail($id);
            Log::info('Menu category fetched successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $menuCategory
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching menu category', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Menu category not found'
            ], 404);
        }
    }

    public function createMenuCategory(array $data)
    {
        Log::info('Creating new menu category', ['data' => $data]);
        try {
            $menuCategory = MenuCategory::create($data);
            Log::info('Menu category created successfully', ['id' => $menuCategory->id]);
            return response()->json([
                'status' => 'success',
                'data' => $menuCategory
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating menu category', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create menu category'
            ], 500);
        }
    }

    public function updateMenuCategory($id, array $data)
    {
        Log::info('Updating menu category', ['id' => $id, 'data' => $data]);
        try {
            $menuCategory = MenuCategory::findOrFail($id);
            $menuCategory->update($data);
            Log::info('Menu category updated successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $menuCategory
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating menu category', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update menu category'
            ], 500);
        }
    }

    public function deleteMenuCategory($id)
    {
        Log::info('Deleting menu category', ['id' => $id]);
        try {
            $menuCategory = MenuCategory::findOrFail($id);
            $menuCategory->delete();
            Log::info('Menu category deleted successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'message' => 'Menu category deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting menu category', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete menu category'
            ], 500);
        }
    }
}
