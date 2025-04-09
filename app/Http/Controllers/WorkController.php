<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function adminIndex(){
        $works = DB::select('
        SELECT users.name, users.middlename, users.lastname, users.class, users.school, works.title, works.path_img, works.score, categories.title as categoriesTitle, works.id, works.category_id, works.user_id
        FROM works
        JOIN users ON works.user_id = users.id JOIN categories ON works.category_id = categories.id
        ');

        return view('dashboard', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $works = Work::where('user_id', '=', Auth::user()->id);

        return view('work.create', compact('works'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255']
        ]);

        $imageName = time() . '.' . $request->path_img->extension();
        $request->file('path_img')->storeAs('works', $imageName, 'public');
        // $request->file('path_image')->store('uploads', 'public');

        // $image = $request->file('path_img');
        // $path = Storage::putFile('app/public', $image);

        if($request -> category_id == 'первая'){
            Work::create([
                'title' => $request->title,
                'path_img' => $imageName,
                'score' => '0',
                'category_id' => 1,
                'user_id' => Auth::user() -> id
            ]);
        }
        else{
            Work::create([
                'title' => $request->title,
                'path_img' => $imageName,
                'score' => '0',
                'category_id' => 2,
                'user_id' => Auth::user() -> id
            ]);
        }



        return redirect('/work');
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request -> validate([
            'score' => ['required', 'integer']
        ]);

        DB::table('works')->where('id', $request->id)->update([
            
            'score' => $request->score
        ]);

    return redirect('/');

        // $request -> work() -> save();
        // Work::update([
            
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }
}
