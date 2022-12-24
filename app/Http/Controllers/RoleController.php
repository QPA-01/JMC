<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{

    const  ROUTE_BASE = 'rol';

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = \App\Models\Role::where('status', 1)->paginate();

            return view('role.index', compact('roles'))
                ->with('i', (request()->input('page', 1) - 1) * $roles->perPage());
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = self::ROUTE_BASE;
        try {
            $role = new \App\Models\Role();
            return view('role.create', compact('role'));
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;
        request()->validate(\App\Models\Role::$rules);
        try {
            \App\Models\Role::create($request->all());
            return redirect()->route('role.index')
                ->with('success', 'Rol creado correctamente.');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $role = \App\Models\Role::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($role)) {
                return view('role.show', compact('role'));
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $role = \App\Models\Role::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($role)) {
                return view('role.edit', compact('role'));
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Role $rol)
    {
        request()->validate(\App\Models\Role::$rules);
        $route = self::ROUTE_BASE;
        try {
            $rol->update($request->all());

            return redirect()->route('rol.index')
                ->with('success', 'Rol editado correctamente.');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $route = self::ROUTE_BASE;

        try {
            $role = \App\Models\Role::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($role)) {
                $role->status = 0;
                $role->update();
                return redirect()->route('rol.index')
                    ->with('success', 'Rol eliminado correctamente');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
