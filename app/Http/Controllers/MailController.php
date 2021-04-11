<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {


   public function sendEmail(Request $request)
   {
      $client = $request->nom;
      $data = array('name'=>"Fit-Sport",'client'=>$client);

      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('abc@gmail.com', 'client')->subject
            ('Demande d\'autorisation d\'accès aux données ');
         $message->from('xyz@gmail.com','name');
      });
      echo "L'email à été envoyer sur la boite mail du client";
   }

   public function viewEmail() {
      $data = array('name'=>"Fit-Sport");
      echo"<h1>Demande d'autorisation d'accès aux données</h1>";
      echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum gravida tincidunt. Nulla porta mauris suscipit tincidunt blandit. Praesent suscipit, felis non iaculis vehicula, massa tortor vulputate orci, ultricies mattis libero nulla vitae metus. Integer vitae efficitur magna. Vestibulum vitae posuere nunc. Praesent nec tempus tellus. Suspendisse egestas velit vitae neque iaculis, eu sodales magna consectetur. Mauris ut diam et justo volutpat tempor id id ipsum. Phasellus lectus augue, fermentum eget purus nec, facilisis euismod elit. Etiam vehicula turpis in vehicula pellentesque. Aliquam ac lacus suscipit, placerat urna et, scelerisque risus. Donec pellentesque turpis non nibh venenatis, ut suscipit massa vehicula. Fusce nulla orci, vehicula sit amet tempor ac, venenatis ut sapien. Sed non dignissim ipsum. Pellentesque laoreet quis ligula ut fringilla. .";
      echo'<a href="">';

   }

}
