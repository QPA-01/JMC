<?php

namespace App\Http\Controllers;

/**
 * Class CategoryEquipmentController
 * @package App\Http\Controllers
 */
class CategoryEquipmentController extends Controller
{

    const ROUTE_BASE = 'category_equipment';

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
            $categoryEquipments = \App\Models\CategoryEquipment::where('status', 1)->paginate();

            return view('category-equipment.index', compact('categoryEquipments'))
                ->with('i', (request()->input('page', 1) - 1) * $categoryEquipments->perPage());
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
        try {
            $categoryEquipment = new \App\Models\CategoryEquipment();
            return view('category-equipment.create', compact('categoryEquipment'));
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
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
        request()->validate(\App\Models\CategoryEquipment::$rules);

        try {
            $categoryEquipment = \App\Models\CategoryEquipment::create($request->all());

            return redirect()->route('category_equipment.index')
                ->with('success', 'Categoría de equipo creado correctamente. ');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
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
            $categoryEquipment = \App\Models\CategoryEquipment::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($categoryEquipment)) {
                return view('category-equipment.show', compact('categoryEquipment'));
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
            $categoryEquipment = \App\Models\CategoryEquipment::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($categoryEquipment)) {
                return view('category-equipment.edit', compact('categoryEquipment'));
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
     * @param  \App\Models\CategoryEquipment $categoryEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\CategoryEquipment $categoryEquipment)
    {
        $route = self::ROUTE_BASE;

        try {
            request()->validate(\App\Models\CategoryEquipment::$rules);

            $categoryEquipment->update($request->all());

            return redirect()->route('category_equipment.index')
                ->with('success', 'Categoría de equipo editado correctamente.');
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
            $categoryEquipment = \App\Models\CategoryEquipment::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($categoryEquipment)) {
                $categoryEquipment->status = 0;
                $categoryEquipment->update();
                return redirect()->route('category_equipment.index')
                    ->with('success', 'Categoría de equipo eliminada correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
