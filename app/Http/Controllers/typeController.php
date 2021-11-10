<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Type;

class typeController extends Controller
{
    public function gettypes() {
        $results = DB::select('select * from types ORDER BY id DESC ');
        return response()->json($results, 200); 
    }

    public function gettypesforselect() {
        $types = array();
        $results = DB::select('select distinct type from types  ');
        $results1 = DB::select('select distinct soustype from types  ');
        $types []=$results;
        $types []=$results1;
        return response()->json($types, 200);
        //$results = DB::select('select distinct type from types  ');
     
        //return response()->json($results, 200); 
    }

    public function getSoustypes(Request $request, $type) {
        $results1 = DB::select('select distinct soustype from types where type=:c ',["c"=>$type]);
     
        return response()->json($results1, 200); 
    }

    //insert User
    public function insertType(Request $request) {
        $data=array('type'=>$request->type,'soustype'=>$request->soustype);
        DB::table('types')->insert($data);
       
        return response($data, 201);
    }

   

    //delete User
    public function deletetype(Request $request, $id) {
        $Type = Type::find($id);
        if(is_null($Type)) {
            return response()->json(['message' => 'Type Not Found'], 404);
        }
        $Type->delete();
        return response()->json(null, 204);
    }}
