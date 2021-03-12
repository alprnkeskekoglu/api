<?php

namespace Dawnstar\Api\Http\Controllers;

use Dawnstar\Api\Contracts\Resources\Output\JsonOutput;
use Dawnstar\Api\Contracts\Repositories\CategoryRepository;
use Dawnstar\Api\Contracts\Resources\CategoryResource;
use Dawnstar\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var CategoryResource
     */
    private $categoryResource;
    /**
     * @var JsonOutput
     */
    private $jsonOutput;

    public function __construct(CategoryRepository $categoryRepository, CategoryResource $categoryResource, JsonOutput $jsonOutput)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->categoryResource = $categoryResource;
        $this->jsonOutput = $jsonOutput;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $containers = $this->categoryRepository->getAll();
        $data = $this->categoryResource->collectionToArray($containers);
        return $this->jsonOutput->output($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $container = $this->categoryRepository->getById($id);
        $data = $this->categoryResource->singleToArray($container);
        return $this->jsonOutput->output($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $container = $this->containerRepository->getById($id);
    }
}
