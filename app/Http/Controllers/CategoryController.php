<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service)
    {}

    public function index()
    {
        Gate::authorize('viewAny', Category::class);
        $categories = $this->service->list();

        return response()->json($categories);
    }

    public function store(CategoryStoreRequest $request)
    {
        Gate::authorize('create', Category::class);
        $category = $this->service->store($request);

        return response()->json($category);
    }

    public function show(Category $category)
    {
        Gate::authorize('view', $category);
        return response()->json($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        Gate::authorize('update', $category);
        $category = $this->service->update($request, $category);

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        $this->service->destroy($category);

        return response()->json(['message' => 'Category deleted.']);
    }
}
