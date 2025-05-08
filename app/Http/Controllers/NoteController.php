<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Vies\View;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //recuperare tutte le note in una tabella
        //$notes = DB::table('notes')->get();

        $notes = Note::with('user')->paginate(10);

        return view('notes.index', ['notes'=> $notes]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $max_size = (int) ini_get('upload_max_filesize') *1000;

        $request->validate([
            'title' => 'required|unique:notes|max:255',
            'body' => 'required',
            'image'=> [
                'required',
                'file',
                'image',
                'max:'.$max_size,
            ],
        ]);

        $file = $request->file('image');
        $filePatch = $request->file('image')->store('uploads', 'public');
        if (!$request->file('image')->isValid()) {
            return back()->with('error', 'Errore nel caricamento dell\'immagine')->with('image', $filePatch);
        }

        $note = new Note();
        $note->title = $request->input('title');
        $note->body = $request->input('body');
        $note->user_id = auth()->user()->id;
        $note->image_url = $filePatch;
        $note->save();

        return redirect()->route('notes.index')->with('success', 'Nota creata con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::with('user')->find($id);
        
        if ($note == null) {
            return "Nota non trovata";
        }   
        return view('notes.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $note = Note::findOrFail($id); // recupera la nota dal database
            return view('notes.edit', compact('note')); // passa $note alla view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:notes|max:255',
            'body' => 'required',
        ]);
            $note = Note::findOrFail($id);
            $note->title = $request->input('title');
            $note->body = $request->input('body');
            $note->user_id = auth()->user()->id;
            $note->save();

        return redirect()->route('notes.index')->with('success', 'Nota aggiornata con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return back()->with('success', 'Nota eliminata con successo');
    }

    public function search (Request $request){
    
        $request->validate([
            'search' => 'required',
        ]);
        $notes = Note::where('title', 'like', '%' . $request->input('search') . '%')->paginate();
       
        if (count($notes) > 0) {
            return view('notes.index', ['notes' => $notes]);
        } 
    return redirect()->route('notes.index')->with('warning', 'Nota non trovata');
    }

    public function trashed()
    {
        //recuperare tutte le note in una tabella
        //$notes = DB::table('notes')->get();

        $notes = Note::onlyTrashed()->with('user')->paginate(10);

        return view('notes.trashed', ['notes'=> $notes]);
        
    }

    public function restore(string $id)
    {
        $note = Note::withTrashed()->findOrFail($id);
        $note->restore();
        return redirect()->route('notes.index')->with('success', 'Nota ripristinata con successo');
    }
}