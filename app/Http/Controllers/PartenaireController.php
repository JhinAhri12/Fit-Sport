<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PartenaireController extends Controller
{
    //
    public function index(Request $request)
    {
      //dd($request);
      if(!empty($request['id']) OR !empty($request['nom']) OR !empty($request['bool']))
      {
        $id = $request['id'];
        $nom = $request['nom'];
        $bool = $request['bool'];
        return view('partenaire.index', ['clients' => DB::table('api_clients')->orWhere('client_id', '=', $id)
        ->orWhere('client_name', '=', $nom)->where('active', '=', $bool)->paginate(6)]);
      }
      else
      {
        return view('partenaire.index', ['clients' => DB::table('api_clients')->paginate(6)]);
      }

    }

    public function show(Request $request)
    {
      $url = $request->fullUrl();
      $id = preg_split('/\w+\:\/\/\w+\:\w+\/\w+\//', $url);
      $ids = (int) $id[1];

      $installs = DB::table('api_install_perm')
      ->select('*')
      ->where('client_id','=',$ids)->get();

      $clients =  DB::table('api_clients')
      ->select('*')
      ->where('client_id','=',$ids)->get();

      $grants  = DB::table('api_client_grants')
      ->select('*')
      ->where('client_id','=',$ids)->get();

      return view('partenaire.show')->with(compact('installs','clients','grants'));



    }
}
