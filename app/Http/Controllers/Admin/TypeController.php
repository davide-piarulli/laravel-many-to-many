<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Functions\Helper as Help;
use App\Http\Requests\TypeRequest;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::paginate(20);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $form_data = $request->all();
        $exist = Type::where('name', $form_data['name'])->first();
        if ($exist) {
            return redirect()->route('admin.types.create')->with('error', 'Nome del tipo già esiste');
        } else {
            $new_type = new Type();
            $form_data['slug'] = Help::createSlug($form_data['name'], Type::class);
            //? Riempio e salvo
            $new_type->fill($form_data);
            $new_type->save();
            //? Ridireziono
            return redirect()->route('admin.types.index')->with('success', 'Tipo aggiunto correttamente!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $form_data = $request->all();
        if ($form_data['name'] === $type->name) {
            $form_data['slug'] = $type->slug;
        } else {
            $form_data['slug'] = Help::createSlug($form_data['name'], Type::class);
        }
        $type->update($form_data);
        return redirect()->route('admin.types.index', $type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('deleted', 'Il tipo è stato cancellato');
    }
}
