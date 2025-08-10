<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemRequest;
use App\Repositories\MenuItemRepository;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    protected $menuItemRepository;
    public function __construct(MenuItemRepository $menuItemRepository)
    {
        $this->menuItemRepository = $menuItemRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->menuItemRepository->getAllMenuItems();
    }

    /**
     * Find a menu item by ID.
     */
    public function find()
    {
        return $this->menuItemRepository->getMenuItemById(request()->id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuItemRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('menu-categories', $filename, 'public');
            $data['image'] = $path;
        }
        return $this->menuItemRepository->createMenuItem($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->menuItemRepository->getMenuItemById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->menuItemRepository->getMenuItemById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('menu-categories', $filename, 'public');
            $data['image'] = $path;
        }

        return $this->menuItemRepository->updateMenuItem($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->menuItemRepository->deleteMenuItem($id);
    }

    /**
     * filter menu items by category.
     */
    public function filterByCategory($categoryId)
    {
        return $this->menuItemRepository->getMenuItemsByCategory($categoryId);
    }
}
