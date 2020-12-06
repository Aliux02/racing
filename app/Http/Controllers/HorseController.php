<?php

namespace App\Http\Controllers;

use App\Models\Better;
use App\Models\Horse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horses = Horse::all()->sortBy('name');
        return view('horse.index', ['horses'=> $horses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','min:3','max:64'],
            'runs' => ['integer','required','min:0','max:200'],
            'wins' => ['integer','required','min:0','max:200','lte:runs'],
            //'coefficient' => ['required','min:0','max:10'], // su numeric ima ivercius
            //'about' => ['min:3','max:64'],
        ],
        [
            'name.required' => 'Žirgo vardas privalomas',
            'name.unique' => 'Žirgo vardas turi buti unikalus',
            'name.min' => 'Žirgo vardas per trumpas',
            'name.max' => 'Žirgo vardas per ilgas',

            'runs.required' => 'Begimai privalomi',
            'runs.min' => 'Begimai negali buti neigiamas skaicius',
            'runs.max' => 'Per daug begimu',
            'runs.integer' => 'Begimai turi buti sveikas skaicius',

            'wins.required' => 'laimejimai privalomi',
            'wins.lte' => 'Laimejimu negali buti daugiau nei begimu',
            'wins.min' => 'Laimejimai negali buti neigiamas skaicius',
            'wins.max' => 'Per daug laimejimu',
            'wins.integer' => 'Laimejimai turi buti sveikas skaicius',
            // 'coefficient.required' => 'Koeficientas privalomas',
            // 'coefficient.min' => 'Koeficientas per mazas',
            // 'coefficient.max' => 'Koeficientas per didelis',

            //'about.min' => 'Per mazai simboliu',
            //'about.max' => 'Per daug simboliu',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $horse = new Horse();
        $horse->name = ucfirst($request->name);
        $horse->runs = $request->runs;
        $horse->wins = $request->wins;

        if ($horse->wins == 0) {
            $horse->coefficient = 0;
        }else{$horse->coefficient = $request->runs/$request->wins;}

        $horse->about = $request->about;
        $horse->save();
        return redirect()->route('better.index')->with('success_message','Žirgas '.$horse->name.' sekmingai pridetas');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(horse $horse)
    {
        return view('horse.edit',['horse'=>$horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, horse $horse)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','min:3','max:64'],
            'runs' => ['integer','required','min:0','max:200'],
            'wins' => ['integer','required','min:0','max:200','lte:runs'],
            //'coefficient' => ['required','min:0','max:10'], // su numeric ima ivercius
            //'about' => ['min:3','max:64'],
        ],
        [
            'name.required' => 'Žirgo vardas privalomas',
            'name.unique' => 'Žirgo vardas turi buti unikalus',
            'name.min' => 'Žirgo vardas per trumpas',
            'name.max' => 'Žirgo vardas per ilgas',

            'runs.required' => 'Begimai privalomi',
            'runs.min' => 'Per mazai begimu',
            'runs.max' => 'Per daug begimu',
            'runs.integer' => 'Begimai turi buti sveikas skaicius',

            'wins.required' => 'laimejimai privalomi',
            'wins.lte' => 'Laimejimu negali buti daugiau nei begimu',
            'wins.min' => 'Per mazai laimejimu',
            'wins.max' => 'Per daug laimejimu',
            'wins.integer' => 'Laimejimai turi buti sveikas skaicius',

            // 'coefficient.required' => 'Koeficientas privalomas',
            // 'coefficient.min' => 'Koeficientas per mazas',
            // 'coefficient.max' => 'Koeficientas per didelis',

            //'about.min' => 'Per mazai simboliu',
            //'about.max' => 'Per daug simboliu',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $horse->id = $horse->id;
        $horse->name = ucfirst($request->name);
        $horse->runs = $request->runs;
        $horse->wins = $request->wins;

        if ($horse->wins == 0) {
            $horse->coefficient = 0;
        }else{$horse->coefficient = $request->runs/$request->wins;}
        // $horse->coefficient = $request->runs/$request->wins;
        $horse->about = $request->about;
        $horse->update();
        return redirect()->route('better.index')->with('success_message','Žirgas '.$horse->name.' sekmingai pridetas');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(horse $horse)
    {
        // $betters = Better::where($horse->id,'=','horse_id');
        // // //dd($betters);
        // // dd($betters->name);
        
        // // // if ($horse->id == $better->horse_id) {
        // // //     echo 'cannot delete';
        // // // }
        $horse->delete();
        return redirect()->route('better.index')->with('success_message','Žirgas '.$horse->name.'sekmingai istrintas');
    }
}
