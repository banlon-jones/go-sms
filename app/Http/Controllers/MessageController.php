<?php

namespace App\Http\Controllers;
use App\Group;
use App\Contact;
use App\Message;
use App\Tarif;
use response;
use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
       if (Auth::user()->status == 1){
            $account = $request->momoNumber;
            $amount = $request->amount;
            $channel = $request->channel;
            $message = Message::where('user_id', Auth::user()->id)->where('id',$request->message_id)->first();
            $contacts = $request->contacts;

            //sendSMS::dispatch($contacts);
            foreach($contacts as $contact){
                //send(header,body,contact);
            }


            $transaction = Transaction::create([
                'amount'=>$amount,
                'mobile_account'=>$account,
                'message_id'=>$message->id,
                'channel'=>$channel,
                'transaction_id'=>rand(10000000, 999999999),
                'recipients'=>$request->recipients,
                'user_id'=>Auth::user()->id,

            ]);
            if ($transaction){
                return redirect()->route('transactions')->with('success', 'message successfully sent');
            }
        }else{
            return redirect()->route('home');
        }

    }
    public function draftMessages(){
      //get saved messages only
      if (Auth::check()) {
        $messages = Message::where('user_id',Auth::user()->id)->where('status', 'draft')->get();
        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        $groups = Group::where('user_id', Auth::user()->id)->get();
        if ($messages) {
          return view('messages.save',['messages'=>$messages, 'contacts'=>$contacts,'groups'=>$groups]);
        }
      }else {
        return view('auth.login');
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->status == 1) {
          $contacts = Contact::where('user_id',Auth::user()->id)->get();
          $groups = Group::where('user_id', Auth::user()->id)->get();
          return view('messages.create',['contacts'=>$contacts, 'groups'=>$groups]);
        }else {
          return redirect()->route('home')->with('error','sorry can not compose message account not validated');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function saveDraft(Request $request)
    {
          $user_id = Auth::user()->id;
          $message = Message::create([
            'header'=>$request->input('header'),
            'body'=>$request->input('body'),
            'type'=>$request->input('type'),
            'status'=>'draft' ,
            'user_id'=>$user_id
              ]);
          if ($message) {
            return redirect()->route('messages.save');
          }
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
          $user_id = Auth::user()->id;
          $message = Message::create([
            'header'=>$request->header,
            'body'=>$request->body,
            'type'=>$request->type,
            'status'=>'sent',
            'user_id'=>$user_id
          ]);
          if ($message) {
            return response()->json($message);
          }
        }else {
          return view('auth.login');
        }
    }

    public function invoiceSms(Request $request)
    {
      if (Auth::check()) {
        $message_id = $request->message_id;
        $phone_numbers = $request->contacts;
        $group_ids = $request->group_ids;
        $group_contacts = [];
        $contactCountryCodes = [];
        $country_codes = collect([]);
        //dd($phone_numbers);
          $contacts = collect([]);
          if (!empty($group_ids)) {
              foreach ($group_ids as $group_id) {
                  $group_contact = Group::find($group_id)->contacts()->get()->pluck('phone')->toArray();
                  $contactCountryCode = Group::find($group_id)->contacts()->get()->pluck('country_code')->toArray();
                  array_push($group_contacts, $group_contact);
                  array_push($contactCountryCodes,$contactCountryCode );
              }
              // looping for country codes
              foreach ($contactCountryCodes as $CountryCode) {
                  for ($j = 0; $j < count($CountryCode); $j++) {
                      $country_codes->push($CountryCode[$j]);
                      foreach ($group_contacts as $group_contact) {
                          for ($i = 0; $i < count($group_contact); $i++) {
                              $contacts->push($country_codes[$j].$group_contact[$i]);
                          }
                      }
                  }
              }
          }
          if (!empty($phone_numbers)){
              foreach ($phone_numbers as $phone_number){
                  $contacts->push($phone_number);
              }
          }
          $contacts = $contacts->unique();
              $tarifs = Tarif::where('service','sms')->get();
              // calculating sms unit price
            foreach ($tarifs as $tarif){
                if ($contacts->count() >= $tarif->min && $contacts->count() <= $tarif->max){
                    $price = $tarif->unit_price;
                }else{
                    ;
                }
            }
          return view('users.payment',['contacts'=>$contacts, 'message_id'=>$message_id,'tarifs'=>$tarifs, 'price'=>$price]);
      }else{
          return view('auth.login');
      }

    }

    // email invoice

    public function invoiceEmail(Request $request)
    {
        if (Auth::check()) {
            $message_id = $request->input('message_id');
            $contact_emails = $request->get('contacts');
            $group_ids = $request->get('group_ids');
            $group_emails = [];
            $emails = collect([]);
            if (!empty($group_ids)) {
                foreach ($group_ids as $group_id) {
                    $group_email = Group::find($group_id)->contacts()->get()->pluck('email')->toArray();
                    array_push($group_emails, $group_email);
                }
                // looping for country codes
                        foreach ($group_emails as $group_email) {
                            for ($i = 0; $i < count($group_email); $i++) {
                                $emails->push($group_email[$i]);
                            }
                        }
                    }
            if (!empty($contact_emails)){
                foreach ($contact_emails as $contact_email){
                    $emails->push($contact_email);
                }
                $emails = $emails->unique();
                $tarifs = Tarif::where('service','email')->get();
                // calculating sms unit price
                foreach ($tarifs as $tarif){
                    if ($emails->count() >= $tarif->min && $emails->count() <= $tarif->max){
                        $price = $tarif->unit_price;
                    }else{
                        $price = 0;
                    }
                }
                return view('users.payment',['contacts'=>$emails, 'message_id'=>$message_id,'tarifs'=>$tarifs, 'price'=>$price]);
            }

        }else{
            return view('auth.login');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        if (Auth::check()) {
          $message = Message::where('id',$message->id)->first();
            $contacts = Contact::where('user_id', Auth::user()->id)->get();
            $groups = Group::where('user_id', Auth::user()->id)->get();
          return view('messages.edit',['message'=>$message,'contacts'=>$contacts, 'groups'=>$groups]);
        }else {
          return view('auth.login');
        }
    }
    public function sentMessage(){
      if (Auth::check()) {
        $messages = Message::where('user_id', Auth::user()->id)
            ->where('status', 'sent')->get();
        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        $groups = Group::where('user_id', Auth::user()->id)->get();
        return view('messages.sentbox',['messages'=>$messages,'groups'=>$groups,'contacts'=>$contacts]);
      }else {
        return view('auth.login');
      }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
          if (Auth::check()) {
            $updateMessage = Message::where('id',$message->id)
                                    ->update([
                                      'header'=>$request->input('header'),
                                      'body'=>$request->input('body'),
                                      'type'=>$request->input('type'),
                                      'status'=>"draft"
                                    ]);
            if ($updateMessage) {
              return redirect()->route('messages.save')->with('success','message successfully updated');
            }else {
              return redirect()->route('messages.save')->with('error',' Error can not edit message ' );
            }
          }else {
            return view('auth.login');
          }
    }
    public function update_ajax(Request $request)
    {

            $updateMessage = Message::where('id',$request->message_id)
                ->update([
                    'header'=>$request->header,
                    'body'=>$request->body,
                    'status'=>'sent',
                ]);
            if ($updateMessage) {
                //retrieve message
                $message = Message::find($request->message_id);
                return response()->json($message);
            }else {
                return redirect()->route('messages.save')->with('error',' Error can not edit message ' );
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
      if (Auth::check()) {
        // deletes a user account completely
        $deleteMessage = Message::where('id', $message->id)
                            ->delete();
        if ($deleteMessage){
            return redirect()->route('messages.save')->with('success','message successfully deleted');
        }else{
            return redirect()->route('messages.save')->with('error',"Error can't delete message");
        }
      }
    }
}
