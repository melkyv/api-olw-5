<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
    public function __construct(protected BrandService $service)
    {}

    public function index()
    {
        Gate::authorize('viewAny', Brand::class);
        $brands = $this->service->list();

        return response()->json($brands);
    }

    public function store(BrandStoreRequest $request)
    {
        Gate::authorize('create', Brand::class);
        $brand = $this->service->store($request);

        return response()->json($brand);
    }

    public function show(Brand $brand)
    {
        Gate::authorize('view', $brand);
        return response()->json($brand);
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        Gate::authorize('update', $brand);
        $brand = $this->service->update($request, $brand);

        return response()->json($brand);
    }

    public function destroy(Brand $brand)
    {
        Gate::authorize('delete', $brand);
        $this->service->destroy($brand);

        return response()->json(['message' => 'Brand deleted.']);
    }
}
