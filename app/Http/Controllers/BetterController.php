<?php

namespace App\Http\Controllers;


use App\Models\Horse;
use App\Http\Controllers\HorseController;

use Illuminate\Support\Facades\Validator;


use App\Models\Better;
use Illuminate\Http\Request;

class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $horse = new Horse();
        $horses = Horse::all()->sortBy('name');
        $betters = Better::all()->sortBydesc('bet');
        return view('better.index',['betters'=>$betters],['horses'=> $horses])->with('horse',$horse);
    }

    public function winner()
    {
        $horses = Horse::all()->sortBy('name');

        if ($horses == '[]') {
            return redirect()->route('better.index')->with('no_horses_message','Nera arkliu aikstyne ');
        }

        foreach ($horses as $horse) { 
            $horse->runs += 1;

            if ($horse->wins == 0) {
                $horse->coefficient = 0;
            }else{$horse->coefficient = $horse->runs/$horse->wins;}

            $horse->save();
        }
               
        $horse = Horse::all()->random(1)[0];

        $horse->wins += 1;
        $horse->coefficient = $horse->runs/$horse->wins;
        $horse->save();

        $betters = Better::all()->sortByDesc('bet');//if bet == 0?
        for ($i=0; $i <count($betters) ; $i++) { 
            if( $betters[$i]->horse_id == $horse->id){

                $horse->coefficient = $horse->runs/$horse->wins;
                $betters[$i]->bet_win = $betters[$i]->bet*$horse->coefficient;
                $horse->save();
            }else{
                $betters[$i]->bet_win = 0;
            };
            
            $betters[$i]->overAll_win += $betters[$i]->bet_win;
            $betters[$i]->bet =0;
            $betters[$i]->save();
        }


        ///dd($betters);
        //return view('better.index',['betters'=>$betters],['horses'=> $horses])->with('horse',$horse);
        return redirect()->route('better.index')->with('horse_message','And the winner is '.$horse->name);
    }

    public function sort()
    {
        $horses = Horse::all()->sortBy('name');
        if($_GET['horse_id'] == 0 ){
            $betters = Better::all();
            return redirect()->route('better.index');
        }
        else{
            $betters = Better::where('horse_id','=',$_GET['horse_id'])->get();
            return view('better.index',['horses'=> $horses],['betters'=>$betters]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = Horse::all()->sortBy('name');
        return view('better.create',['horses'=> $horses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['bet'=> str_replace(',','.',$request->bet)]) ;
        //$request->bet = str_replace(',','.',$request->bet);
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','unique:betters','min:3','max:64'],
            'surname' => ['required','min:1','max:64'],
            'bet' => ['required','numeric','min:1','max:5000'],
        ],
        [
            'name.required' => 'Zaidejo vardas privalomas',
            'name.unique' => 'Zaidejo vardas turi buti unikalus',
            'name.min' => 'Zaidejo vardas per trumpas',
            'name.max' => 'Zaidejo vardas per ilgas',

            'surname.required' => 'Zaidejo pavarde privaloma',
            'surname.min' => 'Zaidejo pavarde per trumpa',
            'surname.max' => 'Zaidejo pavarde per ilga',

            'bet.required' => 'Statymas privalomas',
            'bet.numeric' => 'Statymas turi buti skaicius',
            'bet.min' => 'Statymas negali buti mazesnis nei 1 pinigas',
            'bet.max' => 'Statymas per didelis',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        $better = new Better();
        $better->name = ucfirst($request->name);
        $better->surname = ucfirst($request->name);
        $better->bet = str_replace(',','.',$request->bet); ///jei bet tuscias??
        $better->bet_win = $request->bet_win;
        $better->overAll_win = $request->overAll_win ;
        $better->horse_id = $request->horse_id; 

        //dd($better->overAll_win);
        if ($request->horse_id == null) {
            return redirect()->route('better.index')->with('no_horses_choosen_message','Arklys turi buti pasirinktas');
        }
        $better->save();
        return redirect()->route('better.index')->with('success_message','Losejas '.$better->name.'sekmingai pridetas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(better $better)
    {
        $horses = Horse::all();
        return view('better.edit',['better'=>$better],['horses'=> $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, better $better)
    {
        $request->merge(['bet'=> str_replace(',','.',$request->bet)]) ;
        //$request->bet = str_replace(',','.',$request->bet);
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','min:3','max:64'],
            'surname' => ['required','min:1','max:64'],
            'bet' => ['required','numeric','min:1','max:5000'],
        ],
        [
            'name.required' => 'Zaidejo vardas privalomas',
            'name.min' => 'Zaidejo vardas per trumpas',
            'name.max' => 'Zaidejo vardas per ilgas',

            'surname.required' => 'Zaidejo pavarde privaloma',
            'surname.min' => 'Zaidejo pavarde per trumpa',
            'surname.max' => 'Zaidejo pavarde per ilga',

            'bet.required' => 'Statymas privalomas',
            'bet.numeric' => 'Statymas turi buti skaicius',
            'bet.min' => 'Statymas per mazas',
            'bet.max' => 'Statymas per didelis',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $better->id = $better->id;
        $better->name = ucfirst($request->name);
        $better->surname = $request->surname;
        $better->bet = str_replace(',','.',$request->bet);
        $better->horse_id = $request->horse_id; 
        $better->update();
        return redirect()->route('better.index')->with('success_message','Žaidejas '.$better->name.'sekmingai pakoreguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(better $better)
    {
        $better->delete();
        return redirect()->route('better.index')->with('success_message','Žaidejas '.$better->title.'sekmingai istrintas');
    }
}
