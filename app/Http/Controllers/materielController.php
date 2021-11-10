<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materiel;
use App\Statistique;

use Illuminate\Support\Facades\DB;

class materielController extends Controller
{
   
    //get all Products
    public function getMateriels() {
        $results = DB::select('select * from materiels ');
       
    return response()->json($results, 200); 
    }


    public function home() {
        $statistique= array();
        $results = DB::select('select distinct vdp from materiels ');
        for ($i = 0; $i < count($results); $i++) {
            $results1 = DB::select('select distinct soustype from materiels WHERE vdp=:v',["v"=>$results[$i]->vdp]);
            
                
            for ($j = 0; $j < count($results1); $j++) {
                $results2 = DB::select('select count(*) as count from materiels where soustype=:s and vdp=:v',["s"=>$results1[$j]->soustype,"v"=>$results[$i]->vdp]);
                $object=new Statistique();
                $object->vdp=$results[$i]->vdp;
                $object->soustype=$results1[$j]->soustype;
                $object->count=$results2[0]->count;
                $statistique []=$object;
                
            }
        }
        return response()->json($statistique, 200);
       
    }


    public function getMaterielsByVDP($data) {
        $results = DB::select('select * from materiels where vdp=:i ',["i"=>$data]);
       
    return response()->json($results, 200);
    }


    public function getMaterielsInvoice(Request $request) {
      
            $results = DB::select('select * from materiels where vdp=:i  and name=:n',["i"=>$request[0],"n"=>$request[1]]);
    
       
    return response()->json($results, 200);
    }
      

    //get single Product
        public function getMateriel($id) {
            $Materiel = Materiel::find($id);
            if(is_null($Materiel)) {
                return response()->json(['message' => 'Materiel Not Found'], 404);
            }
            return response()->json($Materiel::find($id), 200);
        }

    //insert Product
    public function insertMateriel(Request $request) {
        
        $data=array('name'=>$request->name,'soustype'=>$request->soustype,"numserie"=>$request->numserie,"marque"=>$request->marque,"vdp"=>$request->vdp);
        $test=DB::table('materiels')->insert($data);
        if($test){
            $results = DB::select('select * from materiels order by id DESC limit 1 ');
            $codeqr=$results[0]->vdp.'-'.$results[0]->name.'-'.$results[0]->id;
            DB::update('update materiels set codeqr=:n where id=:i', ['n'=>$codeqr,'i'=>$results[0]->id]);
        }

        return response()->json($codeqr, 201);
    }


    public function editMateriel(Request $request) {
        $id=$request[0];
        $codeqr=$request[1]['vdp'].'-'.$request[1]['name'].'-'.$request[1]['id'];
        DB::update('update materiels set codeqr=:cc,name=:n,soustype=:st,numserie=:c,marque=:m,vdp=:vdp where id=:i', ['cc'=>$codeqr,'n'=>$request[1]['name'],'st'=>$request[1]['soustype'],'c'=>$request[1]['numserie'],'m'=>$request[1]['marque'],'vdp'=>$request[1]['vdp'],'i'=>$id]);

        return response($request, 200);
    }



 //delete Product
 public function deleteMateriels(Request $request, $id) {
    $Materiel = Materiel::find($id);
    if(is_null($Materiel)) {
        return response()->json(['message' => 'Materiel Not Found'], 404);
    }
    $Materiel->delete();
    return response()->json(null, 204);
}

}
