<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParameterRequest;
use App\Repositories\ParameterRepository;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    protected $parameterRepository;

    public function __construct(ParameterRepository $parameterRepository)
    {
        $this->parameterRepository = $parameterRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->parameterRepository->getAllParameters();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParameterRequest $request)
    {
        $parameter = $request->validated();
        return $this->parameterRepository->createParameter($parameter);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->parameterRepository->getParameterById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParameterRequest $request, string $id)
    {
        $parameter = $request->validated();
        return $this->parameterRepository->updateParameter($id, $parameter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->parameterRepository->deleteParameter($id);
    }
}
