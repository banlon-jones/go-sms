<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use response;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        if (Auth::check()) {
          $contacts = Contact::where('user_id', Auth::user()->id)->get();
          //dd($contacts);
          return view('contacts.index',['contacts'=>$contacts]);
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
        if (Auth::check()) {
          return view('contacts.create');
        }else {
          return view('auth.login');
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
      $user_id = Auth::user()->id;
      $contact = null;
        if(DB::table('contacts')->where('user_id', Auth::user()->id)->where('phone', $request->input('phone_1'))->doesntExist()){
            //contact does not exist execute
            $contact = Contact::create([
                'name'=>$request->input('name_1'),
                'country_code'=>$request->input('country_code'),
                'email'=>$request->input('email_1'),
                'phone'=>$request->input('phone_1'),
                'user_id'=>$user_id
            ]);
        }
      if($contact){
        return redirect()->route('contacts.index')->with('success','Contact successfully created');
      }else {
          return redirect()->back()->withInput()->with('error','Contact already exist');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */


    public function importContacts(Request $request)
    {
        $addcontacts = null;
        $user_id = Auth::user()->id;
      //check if file is valid
      $this->validate($request,[
        'contacts'=>'required|mimes:csv,txt'
      ]);
      if (($handle = fopen($_FILES['contacts']['tmp_name'],"r")) !== false ) {
        fgetcsv($handle); // remove the first row of the file
        while (($data = fgetcsv($handle,1000,",")) !== false ) {
          if(DB::table('contacts')->where('user_id', Auth::user()->id)->where('phone', $data[2])->doesntExist()){
              //contact does not exist execute
              $addcontacts = Contact::create([
                  'name'=>$data[0],
                  'country_code'=>'+'.$data[1],
                  'phone'=>$data[2],
                  'email'=>$data[3],
                  'user_id'=>$user_id
              ]);
          }

        }
        if ($addcontacts) {
          return redirect()->route('contacts.index')->with('success','contacts successfully uploaded !!!');
        }else {
            return redirect()->route('contacts.index')->with('error','contacts fail to upload ');
        }
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::check()) {
          $updateContact = Contact::where('id',$request->contact_id)->update([
            'name'=>$request->name,
            'country_code'=>$request->country_code,
            'email'=>$request->email,
            'phone'=>$request->phone,
          ]);
          if ($updateContact) {
              $contact =  Contact::find($request->contact_id);
            return response()->json($contact);
          }else {
            redirect()->back()->withInput();
          }
        }else {
          return view('auth.login');
        }
    }
    public function contactTemplate(){
        $data = " Name, Country_Code, Phone Number, Email";
        header('Content-Type: application/csv');
        header('Content-Disposition:$updateContact attachment; filename=contacts.csv');
        echo $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
      if (Auth::check()) {
        // deletes a user account completely
        $deleteContact = Contact::where('id', $contact->id)
                            ->delete();
        if ($deleteContact){
            return response()->json();
        }else{
            return redirect()->route('contacts.index')->with('error',"Error can't delete Contact ");
        }
      }

    }
}
