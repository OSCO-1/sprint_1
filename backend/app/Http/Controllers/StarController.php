<?php

namespace App\Http\Controllers;

use App\Http\Requests\StarRequest;
use App\Repositories\StarRepository;
use Illuminate\Http\Request;

class StarController extends Controller
{
    protected $starRepository;

    public function __construct(StarRepository $starRepository)
    {
        $this->starRepository = $starRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->starRepository->getAllStars();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StarRequest $request)
    {
        $star = $request->validated();
        return $this->starRepository->createStar($star);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->starRepository->getStarById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StarRequest $request, string $id)
    {
        $star = $request->validated();
        return $this->starRepository->updateStar($id, $star);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->starRepository->deleteStar($id);
    }
}
