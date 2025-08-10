<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Repositories\TableRepository;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $tableRepository;
    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->tableRepository->getAllTables();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableRequest $tableRequest)
    {
        $data = $tableRequest->validated();
        return $this->tableRepository->createTable($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->tableRepository->getTableById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {

    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(TableRequest $tableRequest, string $id)
    {
        $data = $tableRequest->validated();
        return $this->tableRepository->updateTable($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->tableRepository->deleteTable($id);
    }
}
