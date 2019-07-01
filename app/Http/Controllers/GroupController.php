<?php

namespace App\Http\Controllers;

use App\Group;
use App\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
          $groups = Group::where('user_id',Auth::user()->id)->get();
          return view('groups.index',['groups'=>$groups]);
        }else {
          return view('auth.login');
        }
    }
    /*
     * adds uploaded contacts directly to groups
     */
    public function uploadToGroup(Request $request){

            //check if file is valid
            $this->validate($request,[
                'contacts'=>'required|mimes:csv,txt'
            ]);
            $contact_ids = collect([]);
            if (($handle = fopen($_FILES['contacts']['tmp_name'],"r")) !== false ) {
                fgetcsv($handle); // remove the first row of the file
                while (($data = fgetcsv($handle,1000,",")) !== false ) {
                    $user_id = Auth::user()->id;
                    $addcontacts = Contact::create([
                        'name'=>$data[0],
                        'country_code'=>'+'.$data[1],
                        'phone'=>$data[2],
                        'email'=>$data[3],
                        'user_id'=>$user_id
                    ]);
                    $contact_ids->push($addcontacts->id);
                }
                $group = Group::where('id',$request->input('group_id'))->first();
                if ($group->user_id == Auth::user()->id) {
                    foreach ($contact_ids as $contact_id) {
                        //check if contact already exist
                        $contactexist = DB::table('contact_group')->where('group_id', $group->id)
                            ->where('contact_id', $contact_id)
                            ->exists();
                        if(!$contactexist){
                            DB::table('contact_group')->insert(
                                ['group_id' => $group->id, 'contact_id' => $contact_id]
                            );
                        }

                    }
                    return redirect()->route('groups.addcontacts',['group_id'=>$group->id])->with('success','contact successfully removed');
                }


            }

    }
    public function addContacts($group_id){
      if (Auth::check()) {
        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        $group = Group::where('id',$group_id)->first();
        return view('groups.addcontacts',['group'=>$group,'contacts'=>$contacts]);
      }else {
        return view('auth.login');
      }
    }
    public function addcontact(Request $request)
    {
        $user_id = Auth::user()->id;
        $group = Group::where('id',$request->group_id)->first();

        if ($group->user_id == $user_id) {
          $contact = Contact::where('id',$request->contact_id)->first();
          //check if contact already exist
          $contactGroup = DB::table('contact_group')->where('group_id', $group->id)
                                                    ->where('contact_id', $contact->id)
                                                    ->exists();
        if ($contactGroup) {
          return redirect()->route('groups.addcontacts',['group_id'=>$group->id])->with('error',' contact already added');
        }
          $group->contacts()->attach($contact->id);
          return response()->json($contact);
        }else {
          return redirect()->route('groups.addcontacts')->with('error','error adding contact to group');
        }

    }
    public function removeContact(Request $request)
    {
      if (Auth::check()) {
        $user_id = Auth::user()->id;
        $group = Group::where('id',$request->group_id)->first();
        if ($group->user_id == $user_id) {
          $contact = Contact::where('id',$request->contact_id)->first();
          $group->contacts()->detach($contact->id);
          return redirect()->route('groups.addcontacts',['group_id'=>$group->id])->with('success','contact successfully removed');
        }else {
          return redirect()->route('groups.addcontacts')->with('error','error removing contact from group');
        }
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
    public function addGroup(Request $request)
    {
        if (Auth::check()) {
          $user = Auth::user()->id;
          $createGroup = Group::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=> $user
          ]);
          if ($createGroup) {
            return response()->json($createGroup);
          }else {
            back()->withInput()->with('error','Error occured while updating group');
          }
        }else {
          return view('auth.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function editGroup(Request $request)
    {
      if (Auth::check()){
          $updateGroup = Group::where('id', $request->id)->update([
              'name'=>$request->name,
              'description'=>$request->description,
          ]);
          if ($updateGroup){
              $group = Group::find($request->id);
              return response()->json($group);
          }else{
              return back()->withInput();
          }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          // deletes a group completely
          $deleteGroup = Group::where('id', $request->id)
                              ->delete();
          if ($deleteGroup){
              return response()->json($deleteGroup);
          }else{
              return response()->json($deleteGroup);
          }

    }
}
