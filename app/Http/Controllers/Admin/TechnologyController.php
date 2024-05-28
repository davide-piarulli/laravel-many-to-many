<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper as Help;
use App\Http\Requests\TechnologyRequest;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::paginate(20);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnologyRequest $request)
    {
        $form_data = $request->all();
        $exist = Technology::where('name', $form_data['name'])->first();
        if ($exist) {
            return redirect()->route('admin.technologies.create')->with('error', 'Nome della tecnologia già esiste');
        } else {
            $new_technology = new Technology();
            $form_data['slug'] = Help::createSlug($form_data['name'], Technology::class);
            //? Riempio e salvo
            $new_technology->fill($form_data);
            $new_technology->save();
            //? Ridireziono
            return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia aggiunta correttamente!');
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
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $form_data = $request->all();
        if ($form_data['name'] === $technology->name) {
            $form_data['slug'] = $technology->slug;
        } else {
            $form_data['slug'] = Help::createSlug($form_data['name'], Technology::class);
        }
        $technology->update($form_data);
        return redirect()->route('admin.technologies.index', $technology);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('deleted', 'La tecnologia è stata cancellata');
    }
}
