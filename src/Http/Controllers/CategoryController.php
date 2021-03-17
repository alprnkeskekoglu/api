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
        $container = $this->categoryRepository->getById($id);
        $updatedContainer = $this->categoryRepository->update($request, $container);
        $data = $this->categoryResource->singleToArray($updatedContainer);
        return $this->jsonOutput->output($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->getById($id);
        $this->categoryRepository->destroy($category);

        return $this->jsonOutput->output(['message' => $id . ' id\'li kategori başarıyla silindi!']);
    }
}
