<?php

namespace Dawnstar\Api\Http\Controllers;

use Dawnstar\Api\Contracts\Repositories\PageRepository;
use Dawnstar\Api\Contracts\Resources\Output\JsonOutput;
use Dawnstar\Api\Contracts\Resources\PageResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PageController extends BaseController
{
    /**
     * @var PageRepository
     */
    private PageRepository $pageRepository;
    /**
     * @var PageResource
     */
    private PageResource $pageResource;
    /**
     * @var JsonOutput
     */
    private JsonOutput $jsonOutput;

    public function __construct(PageRepository $pageRepository, PageResource $pageResource, JsonOutput $jsonOutput)
    {
        parent::__construct();
        $this->pageRepository = $pageRepository;
        $this->pageResource = $pageResource;
        $this->jsonOutput = $jsonOutput;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pageRepository->getAll();
        $data = $this->pageResource->collectionToArray($pages);
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
    public function show($id)
    {
        $page = $this->pageRepository->getById($id);
        $data = $this->pageResource->singleToArray($page);
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
        //
    }
}
