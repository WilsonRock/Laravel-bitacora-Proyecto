<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\NodeHasNodes;
use App\Models\Nodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'type_node_id' => 'required',
            'titulo' => 'required',
            'identificacion' => 'required',
            'contacto' => 'required',
            'cifras' => 'required',
            'oportunidades' => 'required',
            'premio' => 'required',
            'precio' => 'required',
            'comision' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'required|date'
        ]);
        try {
            $node = Nodes::create(['type_node_id' => $request->type_node_id]);
            $game = Games::create([
                'titulo' => $request->titulo,
                'identificacion' => $request->identificacion,
                'contacto' => $request->contacto,
                'cifras' => $request->cifras,
                'oportunidades' => $request->oportunidades,
                'premio' => $request->premio,
                'precio' => $request->precio,
                'comision' => $request->comision,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_final' => $request->fecha_final,
                'node_id' => $node->id
            ]);
            $has_node = NodeHasNodes::create([
                'padre_id' => Auth::user()->node_id,
                'hijo_id' => $node->id
            ]);
            return response()->json(['message' => 'Juego creado con éxito','data' => $game], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $games)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit(Games $games)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Games $games)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(Games $games)
    {
        //
    }
}
