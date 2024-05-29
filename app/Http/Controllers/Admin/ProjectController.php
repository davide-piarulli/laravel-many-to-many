<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Functions\Helper;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // con l'IF faccio la ricerca del progetto, altrimenti restituisco tutti i progetti.
        if (isset($_GET['toSearch'])) {
            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(15);
        } else {

            $projects = Project::orderByDesc('id')->paginate(10);
        }
        $types = Type::all();
        $technologies = Technology::all();


        return view('admin.projects.index', compact('projects', 'types', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // prima di inserire un nuovo progetto, devo verificare che non sia già presente
        // dump($request->all());
        $form_data = $request->all();

        // verifico esistenza dell'immagine
        if (array_key_exists('img', $form_data)) {
            // salvo img nello storage
            $img_path = Storage::put('uploads', $form_data['img']);
            // ottengo il nome originale dell'img
            $original_name = $request->file('img')->getClientOriginalName();
            $form_data['img'] = $img_path;
            $form_data['img_original_name'] = $original_name;
            // dump($img_path);
        }
        $exist = Project::where('title', $form_data['title'])->first();
        // Se esiste ritorno alla index con un messaggio di errore
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Il progetto esiste già');
            // Se NON esiste la salvo e ritorno alla index con messaggio di success
        } else {
            $new_project = new Project();
            $form_data['slug'] = Helper::createSlug($form_data['title'], Project::class);



            $new_project->fill($form_data);
            $new_project->save();

            // l'associazione many to many deve avvenire topo il salvataggio
            // se trovo la chiave technologies, inserisco la relazione nella tabella pivot
            if (array_key_exists('technologies', $form_data)) {
                $new_project->technologies()->attach($form_data['technologies']);
            }
            return redirect()->route('admin.projects.index')->with('success', 'Progetto inserito correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = Project::find($project->id);
        if ($project) {
            return view('admin.projects.show', compact('project'));
        } else {
            return redirect()->route('admin.projects.index')->with('error', 'Project non trovato');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $title = 'Modifica progetto';
        $route = route('admin.projects.update', $project);
        $button = 'Aggiorna progetto';
        $method = 'PUT';
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('title', 'route', 'project', 'button', 'method', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        // dd($project);
        $form_data = $request->all();

        // verifico esistenza dell'immagine
        if (array_key_exists('img', $form_data)) {
            // salvo img nello storage
            $img_path = Storage::put('uploads', $form_data['img']);
            // ottengo il nome originale dell'img
            $original_name = $request->file('img')->getClientOriginalName();
            $form_data['img'] = $img_path;
            $form_data['img_original_name'] = $original_name;
        }

        if ($form_data['title'] === $project->title) {
            $form_data['slug'] = $project->slug;
        } else {
            $form_data['slug'] = Helper::createSlug($form_data['title'], Project::class);
        }

        $project->update($form_data);

        if (array_key_exists('technologies', $form_data)) {
            // aggiorno tutte le relazioni elimimando quelle che eventualmente non ci sono più
            $project->technologies()->sync($form_data['technologies']);
        } else {
            // se non sono presenti ID dentro Technologies elimino tutte le relazioni con technologies
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.index', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Il progetto è stato cancellato con successo.');
    }
}
