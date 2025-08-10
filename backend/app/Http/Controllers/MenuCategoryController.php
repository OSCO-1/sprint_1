<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuCategoryRequest;
use App\Models\MenuCategory;
use App\Repositories\MenuCategoryRepository;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    protected $menuCategoryRepository;

    public function __construct(MenuCategoryRepository $menuCategoryRepository)
    {
        $this->menuCategoryRepository = $menuCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->menuCategoryRepository->getAllMenuCategory();
    }
    /**
     * Find a menu category by ID.
     */
    public function find()
    {
        return $this->menuCategoryRepository->getMenuCategoryById(request()->id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('menu-categories', $filename, 'public');
            $data['image'] = $path;
        }

        return $this->menuCategoryRepository->createMenuCategory($data);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->menuCategoryRepository->getMenuCategoryById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuCategoryRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('menu-categories', $filename, 'public');
            $data['image'] = $path;
        }

        return $this->menuCategoryRepository->updateMenuCategory($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->menuCategoryRepository->deleteMenuCategory($id);
    }
}
