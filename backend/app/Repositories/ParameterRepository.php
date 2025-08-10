<?php
namespace App\Repositories;

use App\Models\Parameter;
use Exception;
use Illuminate\Support\Facades\Log;

class ParameterRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Parameter());
    }
    // get all parameters
    public function getAllParameters()
    {
        Log::info('Fetching all parameters');
        try {
            $parameters = Parameter::with('restaurant')->get();
            Log::info('Parameters fetched successfully', ['count' => $parameters->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $parameters
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching parameters', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch parameters'
            ], 500);
        }
    }
    // get paginated parameters
    public function getPaginatedParameters($perPage = 7)
    {
        Log::info('Fetching paginated parameters');
        try {
            $parameters = Parameter::with('restaurant')->paginate($perPage);
            Log::info('Paginated parameters fetched successfully', ['count' => $parameters->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $parameters
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching paginated parameters', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch paginated parameters'
            ], 500);
        }
    }
    // get parameter by id
    public function getParameterById($parameterId)
    {
        Log::info('Fetching parameter by id', ['id' => $parameterId]);
        try {
            $parameter = Parameter::with('restaurant')->findOrFail($parameterId);
            Log::info('Parameter fetched successfully', ['id' => $parameterId]);
            return response()->json([
                'status' => 'success',
                'data' => $parameter
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching parameter', ['id' => $parameterId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch parameter'
            ], 500);
        }
    }
    // create a new parameter
    public function createParameter(array $data)
    {
        Log::info('Creating new parameter', ['data' => $data]);
        try {
            $parameter = Parameter::create($data);
            Log::info('Parameter created successfully', ['id' => $parameter->id]);
            return response()->json([
                'status' => 'success',
                'data' => $parameter
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating parameter', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create parameter'
            ], 500);
        }
    }
    // update an existing parameter
    public function updateParameter($parameterId, array $data)
    {
        Log::info('Updating parameter', ['id' => $parameterId, 'data' => $data]);
        try {
            $parameter = Parameter::findOrFail(($parameterId));
            $parameter->update($data);
            Log::info('Parameter updated successfully', ['id' => $parameterId]);
            return response()->json([
                'status' => 'success',
                'data' => $parameter
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating parameter', ['id' => $parameterId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update parameter'
            ], 500);
        }
    }
    // delete a parameter
    public function deleteParameter($parameterId)
    {
        Log::info('Deleting parameter', ['id' => $parameterId]);
        try {
            $parameter = Parameter::findOrFail($parameterId);
            $parameter->delete();
            Log::info('Parameter deleted successfully', ['id' => $parameterId]);
            return response()->json([
                'status' => 'success',
                'message' => 'Parameter deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting parameter', ['id' => $parameterId, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete parameter'
            ], 500);
            }
    }
    // search parameters by name
    public function searchParameters($query)
    {
        Log::info('Searching parameters', ['query' => $query]);
        try {
            $parameters = Parameter::with('restaurant')
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();
            Log::info('Parameters searched successfully', ['count' => $parameters->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $parameters
            ], 200);
        } catch (Exception $error) {
            Log::error('Error searching parameters', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to search parameters'
            ], 500);
        }
    }
}
