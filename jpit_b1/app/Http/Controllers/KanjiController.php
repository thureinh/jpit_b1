<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kanji;
use App\KanjiWord;

class KanjiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kanjis = Kanji::orderBy('created_at', 'desc')
                  ->withCount(['kanjiwords'])
                  ->get();
        return view('kanji.index', compact('kanjis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kanji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "kanji" => "required|unique:App\Kanji,kanji",
            "onyomi" => "required",
            "kunyomi" => "required"
        ]);

        $kanji = new Kanji();
        $kanji->kanji = request('kanji');
        $kanji->onyomi = request('onyomi');
        $kanji->konyomi = request('kunyomi');
        $kanji->example = request('example');
        $kanji->save();

        return redirect()->route('kanji.show', $kanji->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kanjis = Kanji::all(['id', 'kanji']);
        $kanji = Kanji::find($id);
        $kanjiwords = Kanji::find($id)->kanjiwords;
        return view('kanji.show', compact('kanji', 'kanjiwords', 'kanjis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kanji = Kanji::find($id);
        $kanji->kanji = $request->topic;
        $kanji->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
