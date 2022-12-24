<?php

namespace App\Http\Controllers;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    const ROUTE_BASE = 'user';

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'update_password', 'update_password_action', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = \App\Models\User::where('id', '!=', auth()->id())
                ->where('status', 1)
                ->orderBy('created_at', 'Desc')
                ->paginate();

            return view('user.index', compact('users'))
                ->with(['role:id,name'])
                ->with(['documentType:id:abbreviation'])
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
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
            $user = new \App\Models\User();
            $rols =  \App\Models\Role::where('status', '=', 1)->pluck('name', 'id');
            $documents_types = \App\Models\DocumentType::where('status', '=', 1)->pluck('name', 'id');
            return view('user.create', compact('user', 'rols', 'documents_types'));
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
        $rules = \App\Models\User::$rules;

        $rules['date_birth'] = [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                if ($value >= date('Y-m-d')) {
                    $fail($attribute . ' the date entered cannot be greater than the current date');
                }
            },
        ];

        $rules['email'] = ['required', 'email', 'unique:users'];
        $rules['document_number'] = ['required', 'integer', 'unique:users'];
        $rules['phone'] = ['required', 'integer', 'unique:users'];
        request()->validate($rules);
        try {
            $data = $request->all();
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['document_number']);
            \App\Models\User::create($data);
            return redirect()->route('user.index')
                ->with('success', 'Usuario creado correctamente.');
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
            $user = \App\Models\User::where('uuid', $uuid)
                ->where('status', 1)
                ->with(['role:id,name', 'documentType:id,abbreviation'])
                ->first();
            if (!empty($user)) {
                $user->age =  \App\Services\Utils::calculate_age($user->date_birth)->data->y ?? 0;
                return view('user.show', compact('user'));
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
            $user = \App\Models\User::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($user)) {
                $rols =  \App\Models\Role::where('status', '=', 1)->pluck('name', 'id');
                $documents_types = \App\Models\DocumentType::where('status', '=', 1)->pluck('name', 'id');
                return view('user.edit', compact('user', 'rols', 'documents_types'));
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
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\User $user)
    {
        $route = self::ROUTE_BASE;
        $rules = \App\Models\User::$rules;
        $data = $request->all();
        $veryfy_user = \App\Models\User::Where(
            function ($query) use ($data) {
                $query->orWhere('email', $data['email'])
                    ->orWhere('document_number', $data['document_number'])
                    ->orWhere('phone', $data['phone']);
            }
        )
            ->where('uuid', '!=', $user->uuid)
            ->first();

        $rules['email'] = [
            'email',
            'required',
            function ($attribute, $value, $fail) use ($veryfy_user) {
                if (!empty($veryfy_user) && $value == $veryfy_user->email) {
                    $fail($attribute . ' entered is already registered.');
                }
            }
        ];

        $rules['document_number'] = [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($veryfy_user) {
                if (!empty($veryfy_user) && $value == $veryfy_user->document_number) {
                    $fail($attribute . ' entered is already registered.');
                }
            }
        ];

        $rules['phone'] = [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($veryfy_user) {
                if (!empty($veryfy_user) && $value == $veryfy_user->phone) {
                    $fail($attribute . ' entered is already registered.');
                }
            }
        ];

        request()->validate($rules);

        try {

            $user->update($request->all());

            return redirect()->route('user.index')
                ->with('success', 'Usuario editado correctamente.');
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
            $user = \App\Models\User::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($user)) {
                $user->status = 0;
                $user->update();
                return redirect()->route('user.index')
                    ->with('success', 'Usuario eliminado correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * update_password
     *
     * @return void
     */
    public function update_password()
    {
        $route = self::ROUTE_BASE;
        try {
            return view('user.update_password');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * update_password_action
     *
     * @param  mixed $request
     * @return void
     */
    public function update_password_action(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;
        request()->validate([
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        try {
            $user = \App\Models\User::where([
                ['id', (int)auth()->id()],
                ['status', 1]
            ])->first();

            if (!empty($user)) {
                $data = $request->all();
                $user->password = \Illuminate\Support\Facades\Hash::make($data['password']);
                $user->update();
                return view('home');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * search
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function search(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;

        try {
            $data = $request->all();

            $users = \App\Models\User::where('status', 1)
                ->where('id', '!=', auth()->id())
                ->where('email', 'LIKE', '%' . $data['email'] . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate();

            return view('user.index', compact('users'))
                ->with(['rol:id,nombre'])
                ->with(['TipoDocumento:id,abreviatura'])
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
