<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\Article\StoreRequest;
use App\Role;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:access-articles', ['only' => ['index']]);
        $this->middleware('permission:read-articles', ['only' => ['edit', 'show']]);
        $this->middleware('permission:create-articles', ['only' => ['store']]);
        $this->middleware('permission:update-articles', ['only' => ['update']]);
        $this->middleware('permission:delete-articles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category', 'user', 'comments')->get();

        return response()->json($articles);
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
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $article = Article::create([
            'name' => $request->name,
            'content' => $request->article,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        return response()->json(['success' => true, 'article_id' => $article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::whereId($id)->with('user', 'comments', 'category')->first();

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found',
            ]);
        }

        return response()->json($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::whereId($id)->first();

        if ($article->user_id === auth()->id() || auth()->user()->hasRole(Role::ROLE_ADMINISTRATOR)) {
            return response()->json($article);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Permission denied',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $article = Article::query()->where('id', $id)->firstOrFail();

        if (empty($article)) {
            abort('404', 'Article not found');
        }

        if ($article->user_id !== auth()->id() || !auth()->user()->hasRole(Role::ROLE_ADMINISTRATOR)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission denied',
            ]);
        }

        $article->fill($request->input());

        if (!$article->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating article ',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Article successfully updated',
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function comments($id)
    {
        $article = Article::whereId($id)->with('user', 'comments')->firstOrFail();

        return response()->json($article);
    }
}
