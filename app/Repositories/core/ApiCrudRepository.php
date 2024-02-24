<?php

namespace App\Repositories\core;

use Illuminate\Http\Request;

class ApiCrudRepository implements ApiCrudRepositoryInterface
{

    /**
     * @param Request $request
     * @param mixed $model
     * @return mixed
     */
    public function index(Request $request, mixed $model) : mixed
    {
        return $model->all();
    }
    
    /**
     * @param Request $request
     * @param mixed $model
     * @return mixed
     */
    public function show(Request $request, int|string $id, mixed $model) : mixed
    {
        return $model->find($id);
    }

    /**
     * @param Request $request
     * @param mixed $model
     * @return mixed
     */
    public function store(Request $request, mixed $model) : mixed
    {
        $model->create($request->all());

        return 'Created successfully';
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @param mixed $model
     * @return mixed
     */
    public function update(Request $request, int|string $id, mixed $model) : mixed
    {
        $record = $model->find($id);

        if($record) {
            foreach ($request->all() as $key => $value) {
                if (array_key_exists($key, $record->getAttributes())) {
                    $record->{$key} = $value; // Update the attribute with the new value
                }
            }            
        }

        $record->save();

        return 'Updated successfully';
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @param mixed $model
     * @return mixed
     */
    public function destroy(Request $request, int|string $id, mixed $model) : mixed
    {
        $model->delete($id);

        return 'Deleted successfully';
    }
}