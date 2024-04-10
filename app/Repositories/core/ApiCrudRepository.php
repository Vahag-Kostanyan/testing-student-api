<?php

namespace App\Repositories\core;

use Illuminate\Http\Request;

class ApiCrudRepository implements ApiCrudRepositoryInterface
{

    /**
     * @param Request $request
     * @param mixed $model
     * @param array $searchFaild
     * @return mixed
     */
    public function index(Request $request, mixed $model, array $searchFaild) : mixed
    {
        $model = $model->query();

        if($request->has('include')){
            $include = explode('.', $request->input('include')); 
            $model->with($include);
        }

        if($request->has('search') && count($searchFaild)){
            foreach($searchFaild as $item)
            {
                $model->orWhere($item, 'like', '%' . $request->input('search') . '%');
            }
        }
        
        $beforeLimitModel = $model;

        if($request->has('sortBy')){
            $model->orderBy($request->input('sortBy'), $request->input('sortDir') ?? 'asc');
        }

        if($request->has('limit')){
            $model->limit($request->input('limit'));
            if($request->has('page')){
                $model->offset($request->input('limit') * ($request->input('page') - 1));
            }
        }
        
        return [
            'data'=> $model->get(),
            'totalData' => $beforeLimitModel->count(),
            'limit' => $request->input('limit') ?? null,
            'page' => $request->input('page') ?? null,
        ];
    }
    
    /**
     * @param Request $request
     * @param mixed $model
     * @return mixed
     */
    public function show(Request $request, int|string $id, mixed $model) : mixed
    {
        $include = [];

        if($request->input('include')){
            $include = explode('.', $request->input('include')); 
        }

        return ['data'=> $model->with($include)->find($id)];
    }

    /**
     * @param Request $request
     * @param mixed $model
     * @return mixed
     */
    public function store(Request $request, mixed $model) : mixed
    {
        $model->create($request->all());

        return ['message'=> 'Created successfully'];
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

        return ['message'=> 'Updated successfully'];
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @param mixed $model
     * @return mixed
     */
    public function destroy(Request $request, int|string $id, mixed $model) : mixed
    {
        $model->find($id)->delete();

        return ['message'=> 'Deleted successfully'];
    }
}