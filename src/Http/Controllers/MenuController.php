<?php

namespace Dawnstar\Api\Http\Controllers;

use Dawnstar\Api\Contracts\Repositories\MenuRepository;
use Dawnstar\Api\Contracts\Resources\Output\JsonOutput;
use Dawnstar\Api\Contracts\Resources\MenuResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MenuController extends BaseController
{
    /**
     * @var MenuRepository
     */
    private MenuRepository $menuRepository;
    /**
     * @var MenuResource
     */
    private MenuResource $menuResource;
    /**
     * @var JsonOutput
     */
    private JsonOutput $jsonOutput;

    public function __construct(MenuRepository $menuRepository, MenuResource $menuResource, JsonOutput $jsonOutput)
    {
        parent::__construct();
        $this->menuRepository = $menuRepository;
        $this->menuResource = $menuResource;
        $this->jsonOutput = $jsonOutput;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menuRepository->getAll();
        $data = $this->menuResource->collectionToArray($menus);
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
        $menu = $this->menuRepository->getById($id);
        $data = $this->menuResource->singleToArray($menu);
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
        //
    }
}
