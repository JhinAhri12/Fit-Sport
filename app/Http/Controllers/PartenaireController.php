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
        $bool = (int) $request['bool'];

        $clients = DB::table('api_clients')->orWhere('client_id', '=', $id)
        ->orWhere('client_name', '=', $nom)->orWhere('active', '=', $bool)->paginate(6);

        return view('partenaire.index')->with(compact('clients'));
      }
      else
      {
        return view('partenaire.index', ['clients' => DB::table('api_clients')->paginate(6)]);
      }

    }

    public function show(Request $request)
    {
      $ids = (int) $request->id;
      $idbr = (int) $request->idBh;

      //dd($idbr);
      if(!empty($idbr))
      {
        $installs = DB::table('api_install_perm')
        ->select('*')
        ->where('install_id','=',$idbr)->get();

        $clients =  DB::table('api_clients')
        ->select('*')
        ->where('client_id','=',$ids)->get();

        $grants  = DB::table('api_client_grants')
        ->select('*')
        ->where('client_id','=',$ids)
        ->where('install_id','=',$idbr)
        ->get();

        return view('partenaire.show')->with(compact('installs','clients','grants'));
      }
      else {

        $clients =  DB::table('api_clients')
        ->select('*')
        ->where('client_id','=',$ids)->get();

        $grants  = DB::table('api_client_grants')
        ->select('*')
        ->where('client_id','=',$ids)->get();

        return view('partenaire.show')->with(compact('installs','clients','grants'));
      }


    }

    public function create(Request $request)
    {
      $perms = $request->perms;
      $tabJson = json_decode($perms);
      $club = $request->nom_club;
      $client = $request->client_id;

     $createPerms = DB::table('api_install_perm')
      ->insert(['structure'=>$club,'client_id' => $client, 'members_read' => $tabJson->{'members_read'}, 'members_write' => $tabJson->{'members_write'},
    'members_add' => $tabJson->{'members_add'},'members_product_add' => $tabJson->{'members_product_add'},'members_payment_schedules_read' => $tabJson->{'members_payment_schedules_read'},
    'members_statistiques_read' => $tabJson->{'members_statistiques_read'},'members_subscription_read' => $tabJson->{'members_subscription_read'},'payment_schedules_read' => $tabJson->{'payment_schedules_read'},
    'payment_schedules_write' => $tabJson->{'payment_schedules_write'},'payment_day_read' => $tabJson->{'payment_day_read'}, ]);

    $selectLastID = DB::table('api_install_perm')->select('install_id')->orderBy('install_id','DESC')->first();

      $createGrants = DB::table('api_client_grants')
      ->insert(['install_id'=> $selectLastID->install_id,'client_id' => $client,'perms' => $perms,'active'=>0]);


    }

    public function updatePartenaireBool(Request $request)
    {
      $id = (int) $request->id;
      $bool = (int) $request->bool;

      $updateClient = DB::table('api_clients')
      ->where('client_id', $id)
      ->update(['active' => $bool]);
    }

    public function updateGrantBool(Request $request)
    {
      $id = (int) $request->id;
      $bool = (int) $request->bool;

      $updateClient = DB::table('api_client_grants')
      ->where('branch_id', $id)
      ->update(['active' => $bool]);
    }

    public function updateInstallBool(Request $request)
    {
      $id = (int) $request->id;
      $idCli = (int) $request->idCli;
      $tabChamp = array("members_read","members_write","members_add","members_product_add","members_payment_schedules_read","members_statistiques_read","members_subscription_read","payment_schedules_read","payment_schedules_write","payment_day_read");

      foreach ($tabChamp as $tc)
      {
        if($request->$tc)
        {
          $bool = $request->$tc;
          if($bool == 'Désactiver')
          {
            $updateClient = DB::table('api_install_perm')
            ->where('install_id', $id)
            ->update([$tc => 0]);
          }
          else
          {
            $updateClient = DB::table('api_install_perm')
            ->where('install_id', $id)
            ->update([$tc => 1]);
          }
        }
      }

      $installs = DB::table('api_install_perm')
      ->select('*')
      ->where('install_id','=',$id)->get();

      $clients =  DB::table('api_clients')
      ->select('*')
      ->where('client_id','=',$idCli)->get();

      $grants  = DB::table('api_client_grants')
      ->select('*')
      ->where('client_id','=',$idCli)
      ->where('install_id','=',$id)
      ->get();

      return view('partenaire.show')->with(compact('installs','clients','grants'));

    }
}
