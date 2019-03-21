<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\User\UserFormRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:access-users', ['only' => ['index']]);
        $this->middleware('permission:read-users', ['only' => ['edit', 'show']]);
        $this->middleware('permission:create-users', ['only' => ['store']]);
        $this->middleware('permission:update-users', ['only' => ['update']]);
        $this->middleware('permission:block-users', ['only' => ['destroy']]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::all());
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $createdUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        $role = Role::where('name', Role::ROLE_EDITOR)->first();
        $createdUser->attachRole($role);

        return response()->json($createdUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::query()
            ->whereId($id)
            ->firstOrFail();

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserFormRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        $user->fill($request->all());

        if (!$user->save()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating user',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User successfully updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::whereId($id)->firstOrFail();

        if ($user->id === auth()->id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Permission denied',
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => $user->name . ' - successfully blocked',
        ]);
    }

    /**
     * Return information about auth user
     *
     * @return array
     */
    public function me()
    {
        $roleWithPermissions = auth()->user()->roles()->with('permissions')->first()->toArray();

        $userPermissions = [];
        foreach ($roleWithPermissions['permissions'] as $userPermission) {
            $explodePermission = explode('-', $userPermission['name']);
            $userPermissions[] = [
                'action' => $explodePermission[0],
                'subject' => $explodePermission[1]
            ];
        }

        return [
            'data' => array_merge(auth()->user()->toArray(), [
                'role' => $roleWithPermissions['name'] ?? null,
                'permissions' => $userPermissions
            ])
        ];
    }
}
