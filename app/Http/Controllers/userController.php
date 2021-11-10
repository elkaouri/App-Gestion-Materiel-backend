<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class userController extends Controller
{
    public function login(Request $request) {
        $results = DB::select('select * from users where login=:l AND password=:p ',['l'=>$request[0],'p'=>$request[1]]);
       if($results){
           return response()->json($results, 200); 
       }
    }
    public function getusers() {
        $results = DB::select('select * from users  ');
        return response()->json($results, 200); 
    }

    //insert User
    public function insertUser(Request $request) {
        $data=array('login'=>$request[0],'password'=>$request[1],'type'=>$request[2]);
        DB::table('users')->insert($data);
       
        return response($data, 201);
    }

    public function updateuser(Request $request) {
        $results = DB::select('select * from users where login=:l AND password=:p ',['l'=>$request[0],'p'=>$request[2]]);
        if($results){
            DB::update('update users set password =:q ,etat=1 where id=:i', ['q'=>$request[1],'i'=>$results[0]->id]);
            return response($results, 201);
        }
       
    }

    //delete User
    public function deleteusers(Request $request, $id) {
        $User = User::find($id);
        if(is_null($User)) {
            return response()->json(['message' => 'users Not Found'], 404);
        }
        $User->delete();
        return response()->json(null, 204);
    }
}
