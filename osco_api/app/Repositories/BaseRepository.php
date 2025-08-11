<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Inject model instance (child repositories must define the model)
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Paginate records
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Find by ID or fail
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Create a new record
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a record by ID
     */
    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    /**
     * Delete a record by ID
     */
    public function delete($id)
    {
        $record = $this->find($id);
        return $record->delete();
    }
}
