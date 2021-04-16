<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mail;

class PartenaireController extends Controller
{
    // page index Route::get('/partenaire', 'PartenaireController@index');
    public function index(Request $request)
    {
      // Si il tout est empty c'est que la recherche n'as pas été lancer.
      if(!empty($request['id']) OR !empty($request['nom']) OR !empty($request['bool']))
      {
        $id = $request['id'];
        $nom = $request['nom'];
        $bool = $request['bool'];

        // si bool est nul on fait une requête différente.
        if($bool == 'nil')
        {
          $bool = 'is null';
          $clients = DB::table('api_clients')->orWhere('client_id', '=', $id)
          ->orWhere('client_name', '=', $nom)->orWhereNull('active', $bool)->paginate(6);
        }
        // sinon requete avec tout les champs
        else {
          $clients = DB::table('api_clients')->where('client_id', '=', $id)
          ->orWhere('client_name', '=', $nom)->orWhere('active', $bool)->paginate(6);
        }

        return view('partenaire.index')->with(compact('clients'));
      }
      // on affiche l'index avec une pagination
      else
      {
        return view('partenaire.index', ['clients' => DB::table('api_clients')->paginate(6)]);
      }

    }

    public function show(Request $request)
    {
      $ids = (int) $request->id;
      $idbr = (int) $request->idBh;

      // si un id branch est passé on veut afficher les droits de cette structure
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
      // Sinon on affiche la page de défaut
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

// on créer un club
    public function create(Request $request)
    {
      $perms = $request->perms;
      $tabJson = json_decode($perms);
      $club = $request->nom_club;
      $client = $request->client_id;

// requête pour insérer les données
     $createPerms = DB::table('api_install_perm')
      ->insert(['structure'=>$club,'client_id' => $client, 'members_read' => $tabJson->{'members_read'}, 'members_write' => $tabJson->{'members_write'},
    'members_add' => $tabJson->{'members_add'},'members_product_add' => $tabJson->{'members_product_add'},'members_payment_schedules_read' => $tabJson->{'members_payment_schedules_read'},
    'members_statistiques_read' => $tabJson->{'members_statistiques_read'},'members_subscription_read' => $tabJson->{'members_subscription_read'},'payment_schedules_read' => $tabJson->{'payment_schedules_read'},
    'payment_schedules_write' => $tabJson->{'payment_schedules_write'},'payment_day_read' => $tabJson->{'payment_day_read'}, ]);

// on cherche le last id pour réaficher la page
    $selectLastID = DB::table('api_install_perm')->select('install_id')->orderBy('install_id','DESC')->first();

      $createGrants = DB::table('api_client_grants')
      ->insert(['install_id'=> $selectLastID->install_id,'client_id' => $client,'perms' => $perms,'active'=>0]);

      $data = array('name'=>"Fit-Sport",'client'=>$client);

// on envoit un mail au client
      Mail::send(['text'=>'mailcre'], $data, function($message) {
         $message->to('abc@gmail.com', 'client')->subject
            ('Création de votre club !');
         $message->from('xyz@gmail.com','name');
      });

      return redirect()->back()->with(['message' => 'Le club à bien été créer !']);
    }

// on met a jour le active d'un parteanire
    public function updatePartenaireBool(Request $request)
    {
      $id = (int) $request->id;
      $bool = (int) $request->bool;

      $updateClient = DB::table('api_clients')
      ->where('client_id', $id)
      ->update(['active' => $bool]);
    }

// on met a jour les champs actif ou non d'un Club
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

      // on revvoit les données pour réafficher la page sur laquelle on était.

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
