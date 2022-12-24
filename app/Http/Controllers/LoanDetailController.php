<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * Class LoanDetailController
 * @package App\Http\Controllers
 */
class LoanDetailController extends Controller
{

    const ROUTE_BASE = 'loan_detail';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $loanDetails = \App\Models\LoanDetail::where('status', 1)->paginate();
            return view('loan-detail.index', compact('loanDetails'))
                ->with('i', (request()->input('page', 1) - 1) * $loanDetails->perPage());
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
    public function create(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;
        try {
            $data = $request->all();

            if (!empty($data['equipment_uuid'])) {
                $equipment = \App\Models\Equipment::where('uuid', $data['equipment_uuid'])->where('status', 1)->first();
                if (!empty($equipment)) {
                    $quantity = $equipment->quantity;
                    $loanDetail = new \App\Models\LoanDetail();
                    $equipment_uuid =  $data['equipment_uuid'];
                    $equipment_name =  $equipment->name;
                    return view('loan-detail.create', compact('loanDetail', 'quantity', 'equipment_uuid', 'equipment_name'));
                } else {
                    $message = 'El equipo ingresado no se encuentra disponible';
                    return view('errors.error', compact('route', 'message'));
                }
            } else {
                return view('errors.404', compact('route'));
            }
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
        $message = 'error desconocido';
        request()->validate(\App\Models\LoanDetail::$rules);
        try {
            $data = $request->all();
            if (!empty($data['equipment_uuid'])) {
                $equipment = \App\Models\Equipment::where('uuid', $data['equipment_uuid'])->where('status', 1)->first();
                if (!empty($equipment)) {
                    if ((int)$data['quantity'] <= (int)$equipment->quantity) {
                        $result_quantity = 0;
                        if ((int)$data['quantity'] != (int)$equipment->quantity) {
                            $result_quantity = $equipment->quantity - $data['quantity'];
                        }
                        $equipment->quantity = $result_quantity;
                        $equipment->update();

                        \App\Models\LoanDetail::create([
                            'description' => $data['description'],
                            'equipament_id' => $equipment->id,
                            'quantity' => $data['quantity'],
                            'user_loan_id' => Auth::user()->id
                        ]);
                    } else {
                        $message_equipment = 'No esta disponible la cantidad ingresada del equipo.';
                        return view('errors.error', compact('route', 'message'));
                    }
                } else {
                    $message_equipment = 'No se encontró el equipo ingresado.';
                    return view('errors.error', compact('route', 'message'));
                }

                return redirect()->route('loan_detail.index')
                    ->with('success', '');
            } else {
                $message = 'No se evidenció equipo';
                return view('errors.error', compact('route', 'message'));
            }
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
            $loanDetail = \App\Models\LoanDetail::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($loanDetail)) {
                return view('loan_detail.show', compact('loanDetail'));
            } else {
                return view('errors.notfound', compact('route'));
            }
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
        try {
            $loanDetail = \App\Models\LoanDetail::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($loanDetail)) {
                return redirect()->route('loan-details.index')
                    ->with('success', 'Prestamo eliminado correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * get_category_sumary_action
     *
     * @return void
     */
    public function get_category_sumary_action()
    {
        $route = self::ROUTE_BASE;

        try {
            $response_category_equipments = self::get_category_sumary();
            if ($response_category_equipments->status) {
                $categories = $response_category_equipments->data;
                return view('loan-detail.sumary', compact('categories'));
            } else {
                $error = $response_category_equipments->message;
                return view('errors.error', compact('route', 'error'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * get_category_sumary
     *
     * @return object
     */
    public static function get_category_sumary(): object
    {
        $response = (object)['status' => true, 'message' => 'success', 'data' => []];
        try {
            $equipments = \App\Models\Equipment::where('quantity', '>', 0)
                ->where('status', 1)
                ->groupBy('category_equipment_id')
                ->get(['category_equipment_id']);
            $response->data = \App\Models\CategoryEquipment::whereIn(
                'id',
                array_column($equipments->toArray(), 'category_equipment_id')
            )
                ->where('status', 1)->pluck('name', 'id');
        } catch (\Exception $ex) {
            $response->message = $ex->getMessage();
            $response->status = false;
        }
        return $response;
    }


    /**
     * get_equipament_sumary_action
     *
     * @return void
     */
    public function get_equipament_sumary_action(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;

        try {
            $data = $request->all();

            if (!empty($data['category_id'])) {
                $equipaments = \App\Models\Equipment::where('quantity', '>', 0)
                    ->where('status', 1)
                    ->where('category_equipment_id', (int)$data['category_id'])
                    ->pluck('name', 'uuid');

                return view('loan-detail.sumary_equipament', compact('equipaments'));
            } else {
                return view('errors.404', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
