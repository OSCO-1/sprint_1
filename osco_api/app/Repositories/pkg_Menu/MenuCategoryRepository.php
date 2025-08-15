<?php

namespace App\Repositories\pkg_Menu;

use App\Models\pkg_Menu\MenuCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;


class MenuCategoryRepository extends BaseRepository
{
    public function __construct(MenuCategory $model)
    {
        parent::__construct($model);
    }


    public function createCategory(array $data)
    {
        // Handle image upload
        if (isset($data['image_url']) && $data['image_url'] instanceof \Illuminate\Http\UploadedFile) {
            // Store the image in storage/app/public/menu_categories
            $path = $data['image_url']->store('menu_categories', 'public');
            $data['image_url'] = $path; // Save relative path
        }

        // Get current max display_order
        $maxOrder = $this->model
            ->where('restaurant_id', $data['restaurant_id'])
            ->max('display_order') ?? 0;

        $data['display_order'] = $maxOrder + 1;

        return $this->model->create($data);
    }



    /**
     * Get all categories for a given restaurant, ordered by display_order.
     *
     * @param int $restaurantId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    /**
     * Get all categories ordered by display_order.
     */
    public function getAll()
    {
        return $this->model->orderBy('display_order')->get();
    }


    /**
     * Update a menu category by ID.
     *
     * @param int $id
     * @param array $data
     * @return MenuCategory|null
     */
    public function updateCategory(int $id, array $data)
    {
        $category = $this->model->find($id);

        if (!$category) {
            return null;
        }

        $category->update($data);

        return $category;
    }

    /**
     * Get a category by its ID.
     *
     * @param int $id
     * @return MenuCategory|null
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }


    /**
     * Delete a menu category by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool
    {
        $category = $this->model->find($id);

        if (!$category) {
            return false;
        }

        return $category->delete();
    }

    /**
     * Reorder categories for a restaurant.
     * 
     * @param array $orderedIds Array of category IDs in new order.
     * Example: [5, 2, 9] → category ID 5 will be display_order 1, ID 2 will be 2, etc.
     */
    public function reorder(array $orderedIds): void
    {
        try {
            \Log::info('Starting reorder process', ['ordered_ids' => $orderedIds]);
            
            // Use database transaction for atomic updates
            DB::transaction(function () use ($orderedIds) {
                foreach ($orderedIds as $order => $id) {
                    \Log::info('Updating category', ['id' => $id, 'new_order' => $order + 1]);
                    
                    // Check if category exists before updating
                    $category = $this->model->find($id);
                    if (!$category) {
                        throw new \Exception("Category with ID {$id} not found");
                    }
                    
                    // Update each category's 'display_order' column
                    $updated = $this->model->where('id', $id)->update(['display_order' => $order + 1]);
                    
                    if (!$updated) {
                        throw new \Exception("Failed to update category {$id}");
                    }
                    
                    \Log::info('Category updated successfully', ['id' => $id, 'order' => $order + 1]);
                }
            });
            
            \Log::info('Reorder process completed successfully');
        } catch (\Exception $e) {
            \Log::error('Reorder process failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'ordered_ids' => $orderedIds
            ]);
            throw $e;
        }
    }
}
