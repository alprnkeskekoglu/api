<?php

namespace Dawnstar\Api\Http\Controllers;

use Dawnstar\Api\Contracts\Resources\Output\JsonOutput;
use Dawnstar\Api\Contracts\Repositories\ContainerRepository;
use Dawnstar\Api\Contracts\Resources\ContainerResource;
use Dawnstar\Models\Language;
use Illuminate\Http\Request;

class ContainerController extends BaseController
{

    /**
     * @var ContainerRepository
     */
    private $containerRepository;
    /**
     * @var ContainerResource
     */
    private $containerResource;
    /**
     * @var JsonOutput
     */
    private $jsonOutput;

    public function __construct(ContainerRepository $containerRepository, ContainerResource $containerResource, JsonOutput $jsonOutput)
    {
        parent::__construct();
        $this->containerRepository = $containerRepository;
        $this->containerResource = $containerResource;
        $this->jsonOutput = $jsonOutput;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $containers = $this->containerRepository->getAll();
        $data = $this->containerResource->collectionToArray($containers);
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
        $container = $this->containerRepository->getById($id);
        $data = $this->containerResource->singleToArray($container);
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
        $container = $this->containerRepository->getById($id);
        $updatedContainer = $this->containerRepository->update($request, $container);
        $data = $this->containerResource->singleToArray($updatedContainer);
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
        $container = $this->containerRepository->getById($id);
        $this->containerRepository->destroy($container);

        return $this->jsonOutput->output(['message' => $id . ' id\'li sayfa yapısı başarıyla silindi!']);
    }
}
