<?php
namespace App\Repositories;

use App\Models\Table;
use Exception;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class TableRepository extends BaseRepository
{
    public function __construct(){
        parent::__construct(new Table());
    }


    public function getAllTables()
    {
        Log::info('Fetching all tables');
        try {
            $tables = Table::all();
            Log::info('Tables fetched successfully', ['count' => $tables->count()]);
            return response()->json([
                'status' => 'success',
                'data' => $tables
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching tables', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch tables'
            ], 500);
        }
    }

    public function getTableById($id)
    {
        Log::info('Fetching table by ID', ['id' => $id]);
        try {
            $table = Table::findOrFail($id);
            Log::info('Table fetched successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $table
            ], 200);
        } catch (Exception $error) {
            Log::error('Error fetching table', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Table not found'
            ], 404);
        }
    }

    public function createTable(array $data)
    {
        Log::info('Creating new table', ['data' => $data]);
        try {
            $table = Table::create($data);
            Log::info('Table created successfully', ['id' => $table->id]);
            return response()->json([
                'status' => 'success',
                'data' => $table
            ], 201);
        } catch (Exception $error) {
            Log::error('Error creating table', ['error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create table'
            ], 500);
        }
    }

    public function updateTable($id, array $data)
    {
        Log::info('Updating table', ['id' => $id, 'data' => $data]);
        try {
            $table = Table::findOrFail($id);
            $table->update($data);
            Log::info('Menu category updated successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'data' => $table
            ], 200);
        } catch (Exception $error) {
            Log::error('Error updating table', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update table'
            ], 500);
        }
    }

    public function deleteTable($id)
    {
        Log::info('Deleting table', ['id' => $id]);
        try {
            $table = Table::findOrFail($id);
            $table->delete();
            Log::info('Table deleted successfully', ['id' => $id]);
            return response()->json([
                'status' => 'success',
                'message' => 'Table deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Error deleting table', ['id' => $id, 'error' => $error->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete table'
            ], 500);
        }
    }
}
