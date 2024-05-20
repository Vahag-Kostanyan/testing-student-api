<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Repositories\core\ApiCrudRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


abstract class ApiCrudController extends Controller implements ApiCrudInterface
{
    use ApiCrudValidationTrait;

    protected $modelClass;
    protected $model;
    protected $indexRepository;
    protected $showRepository;
    protected $storeRepository;
    protected $updateRepository;
    protected $destroyRepository;
    protected $searchField = [];
    protected $allowedIncludes = [];
    protected $role_id;
    protected const METHOD_INDEX = "index";
    protected const METHOD_SHOW = "show";
    protected const METHOD_STORE = "store";
    protected const METHOD_UPDATE = "update";
    protected const METHOD_DESTROY = "destroy";

    /**
     * @inheritDoc
     */
    public function __construct(protected ApiCrudRepositoryInterface $apiCrudRepository)
    {
        $this->model = app($this->modelClass);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_INDEX, $request);

        if($this->indexRepository){
            return response()->json($this->indexRepository->index($request), 200);
        }
        return response()->json($this->apiCrudRepository->index($request, $this->model, $this->searchField), 200);
    }
    
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request, int|string $id) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_SHOW, $request, $id);

        if($this->showRepository){
            return response()->json($this->showRepository->show($request, $id), 200);
        }
        return response()->json($this->apiCrudRepository->show($request, $id, $this->model), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        // Request validatiuon
        $this->validation(self::METHOD_STORE, $request);

        if($this->storeRepository){
            return response()->json($this->storeRepository->store($request), 200);
        }
        return response()->json($this->apiCrudRepository->store($request, $this->model), 200);
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

        if($this->updateRepository){
            return response()->json($this->updateRepository->update($request, $id), 200);
        }
        return response()->json($this->apiCrudRepository->update($request, $id, $this->model), 200);
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

        if($this->destroyRepository){
            return response()->json($this->destroyRepository->destroy($request, $id), 200);
        }
        return response()->json($this->apiCrudRepository->destroy($request, $id, $this->model), 200);
    }
}