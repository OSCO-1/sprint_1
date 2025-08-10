<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdditionalRequest;
use App\Repositories\AdditionalRepository;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    protected $additionalRepository;

    public function __construct(AdditionalRepository $additionalRepository)
    {
        $this->additionalRepository = $additionalRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->additionalRepository->getAllAdditionalItems();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdditionalRequest $request)
    {
        $additional = $request->validated();
        return $this->additionalRepository->createAdditionalItem($additional);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->additionalRepository->getAdditionalItemById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdditionalRequest $request, string $id)
    {
        $additional = $request->validated();
        return $this->additionalRepository->updateAdditionalItem($id, $additional);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->additionalRepository->deleteAdditionalItem($id);
    }
}
