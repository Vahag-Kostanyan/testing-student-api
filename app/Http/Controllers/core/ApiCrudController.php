<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


abstract class ApiCrudController extends Controller implements ApiCrudInterface
{
    use ApiCrudValidationTrate;

    protected $modelClass;
    private $model;

    protected const METHOD_STORE = "store";
    protected const METHOD_UPDATE = "update";
    protected const METHOD_DESTROY = "destroy";

    /**
     * @inheritDoc
     */
    public function __construct(protected ApiCrudRepositoryInterface $apiCrudInterface)
    {
        $this->model = app($this->modelClass);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return response()->json(['data'=> $this->apiCrudInterface->index($request, $this->model), 200]);
    }
    
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request, int|string $id) : JsonResponse
    {
        return response()->json(['data'=> $this->apiCrudInterface->show($request, $id, $this->model), 200]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_STORE, $request);

        return response()->json(['message'=> $this->apiCrudInterface->store($request, $this->model)], 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(Request $request, int|string $id) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_UPDATE, $request, $id);

        return response()->json(['message'=> $this->apiCrudInterface->show($request, $id, $this->model)], 200);
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int|string $id) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_DESTROY, $request, $id);

        return response()->json(['message'=> $this->apiCrudInterface->show($request, $id, $this->model)], 200);
    }
}