<?php

namespace App\Repositories\pkg_Menu;

use App\Models\pkg_Menu\MenuItem;
use App\Repositories\BaseRepository;

class MenuItemRepository extends BaseRepository
{
    public function __construct(MenuItem $model)
    {
        parent::__construct($model);
    }

    /**
     * Create a new menu item.
     */
    public function createItem(array $data)
    {
        // Handle image upload
        if (isset($data['image_url']) && $data['image_url'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image_url']->store('menu_items', 'public');
            // Store the full URL with base path
            $data['image_url'] = $path;
        }

        return $this->model->create($data);
    }

    /**
     * Get all menu items with relationships.
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * Get a menu item by ID with relationships.
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Update a menu item by ID.
     */
    public function updateItem(int $id, array $data)
    {
        \Log::info('Repository updateItem called', [
            'id' => $id,
            'data' => $data
        ]);

        $item = $this->model->find($id);

        if (!$item) {
            \Log::error('Item not found in repository', ['id' => $id]);
            return null;
        }

        \Log::info('Item found, before update', [
            'id' => $id,
            'current_item' => $item->toArray()
        ]);

        // Handle image upload if provided
        if (isset($data['image_url']) && $data['image_url'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image_url']->store('menu_items', 'public');
            // Store the full URL with base path
            $data['image_url'] = 'https://oscoapi-hjtj1.sevalla.app/storage/' . $path;
            \Log::info('Image uploaded', ['path' => $path, 'full_url' => $data['image_url']]);
        }

        $updateResult = $item->update($data);

        \Log::info('Update result', [
            'success' => $updateResult,
            'updated_item' => $item->fresh()->toArray()
        ]);

        return $item->fresh(); // Return fresh instance from database
    }

    /**
     * Delete a menu item by ID.
     */
    public function deleteItem(int $id): bool
    {
        $item = $this->model->find($id);

        if (!$item) {
            return false;
        }

        return $item->delete();
    }
}
