<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShirtOrderResource;
use App\Http\Requests\ShirtOrderRequest;
use App\Repositories\ShirtOrderRepositoryInterface;
use Illuminate\Http\Request;

class ShirtOrderController extends Controller
{
    private $shirtOrderRepository;
  
    public function __construct(ShirtOrderRepositoryInterface $shirtOrderRepository)
    {
       $this->shirtOrderRepository = $shirtOrderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rowsPerPage = ($request->get('rows_per_page') ? $request->get('rows_per_page') : 10);

        $shirtOrder = $this->shirtOrderRepository->paginate($rowsPerPage);

        if ($shirtOrder) {
            $shirtOrderResource = ShirtOrderResource::collection($shirtOrder);

            return $shirtOrderResource;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShirtOrderRequest $request)
    {
        $shirtOrder = $this->shirtOrderRepository->create($request->all());

        if ($shirtOrder) {
            ShirtOrderResource::withoutWrapping();

            $shirtOrderResource = new ShirtOrderResource($shirtOrder);

            return $shirtOrderResource;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShirtOrder  $shirtOrder
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $shirtOrder = $this->shirtOrderRepository->find($id);

        if ($shirtOrder) {
            ShirtOrderResource::withoutWrapping();

            $shirtOrderResource = new ShirtOrderResource($shirtOrder);

            return $shirtOrderResource;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShirtOrder  $shirtOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ShirtOrder $shirtOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShirtOrder  $shirtOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShirtOrder  $shirtOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $shirtOrder = $this->shirtOrderRepository->delete($id);

        return response()->json(null, 204);
    }
}
