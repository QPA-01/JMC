<?php

namespace App\Http\Controllers;


/**
 * Class DocumentTypeController
 * @package App\Http\Controllers
 */
class DocumentTypeController extends Controller
{

    const ROUTE_BASE = 'document_type';

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
        $route = self::ROUTE_BASE;
        try {
            $documentTypes = \App\Models\DocumentType::where('status', 1)->paginate();

            return view('document-type.index', compact('documentTypes'))
                ->with('i', (request()->input('page', 1) - 1) * $documentTypes->perPage());
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
            $documentType = new \App\Models\DocumentType();
            return view('document-type.create', compact('documentType'));
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
        try {
            request()->validate(\App\Models\DocumentType::$rules);

            \App\Models\DocumentType::create($request->all());

            return redirect()->route('document_type.index')
                ->with('success', 'Tipo de documento creado correctamente.');
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
            $documentType = \App\Models\DocumentType::where('uuid', $uuid)->where('status', 1)->first();

            if (!empty($documentType)) {
                return view('document-type.show', compact('documentType'));
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
            $documentType = \App\Models\DocumentType::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($documentType)) {
                return view('document-type.edit', compact('documentType'));
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
     * @param  DocumentType $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\DocumentType $documentType)
    {
        $route = self::ROUTE_BASE;

        try {
            request()->validate(\App\Models\DocumentType::$rules);

            $documentType->update($request->all());

            return redirect()->route('document_type.index')
                ->with('success', 'Tipo de documento editado correctamente.');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $documentType = \App\Models\DocumentType::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($documentType)) {
                $documentType->status = 0;
                $documentType->update();
                return redirect()->route('document_type.index')
                    ->with('success', 'Tipo de documento eliminado correctamente');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
