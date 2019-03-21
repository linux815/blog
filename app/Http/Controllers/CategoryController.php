<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Category\CategoryStoreRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:access-categories', ['only' => ['index']]);
        $this->middleware('permission:read-categories', ['only' => ['edit', 'show']]);
        $this->middleware('permission:create-categories', ['only' => ['store']]);
        $this->middleware('permission:update-categories', ['only' => ['update']]);
        $this->middleware('permission:delete-categories', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        return response()->json($categories);
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
     * @param CategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['success' => true, 'category_id' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::whereId($id)->first();

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ]);
        }

        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::whereId($id)->firstOrFail();

        return response()->json($category);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request, $id)
    {
        $category = Category::query()->where('id', $id)->firstOrFail();
        $category->fill($request->all());

        if (!$category->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating category ',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Category successfully updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
