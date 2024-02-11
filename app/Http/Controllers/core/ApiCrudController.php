<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


abstract class ApiCrudController extends Controller
{
    use ApiCrudValidationTrate;

    protected $modelClass;
    private $model;

    private const METHOD_STORE = "store";
    private const METHOD_UPDATE = "update";
    private const METHOD_DESTROY = "destroy";

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->model = app($this->modelClass);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return response()->json(['data'=> $this->model->all(), 200]);
    }
    
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request, int|string $id) : JsonResponse
    {
        return response()->json(['data'=> $this->model->find($id), 200]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_STORE, $request);

        $this->model->create($request->all());

        return response()->json(['message'=> 'Created successfully'], 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(Request $request, int|string $id) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_UPDATE, $request);
        
        $record = $this->model->find($id);

        if($record) {
            foreach ($request->all() as $key => $value) {
                if (array_key_exists($key, $record->getAttributes())) {
                    $record->{$key} = $value; // Update the attribute with the new value
                }
            }            
        }

        $record->save();

        return response()->json(['message'=> 'Updated successfully'], 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int|string $id) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_DESTROY, $request);


        $this->model->delete($id);

        return response()->json(['message'=> 'Deleted successfully'], 200);
    }
}