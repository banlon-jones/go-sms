<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 1) {
          $notes = Notification::all();
          return view('notifications.index',['notifications'=>$notes]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check if user is an admin
        if (Auth::user()->role_id == 1) {
          return view('notifications.create');
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
      //check if user is an admin
      if (Auth::user()->role_id == 1) {
        $notification = Notification::create([
          'subject'=>$request->input('subject'),
          'body'=>$request->input('body')
        ]);
        if ($notification) {
          return redirect()->route('notifications.index')->with('success','messages successfully saved');
        }
      }else {
        return view('auth.login');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(notification $notification)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(notification $notification)
    {
      if (Auth::user()->role_id == 1) {
        $note = Notification::where('id',$notification->id)->first();
        return view('notifications.edit',['notification'=>$note]);
      }else {
        return view('auth.login');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notification $notification)
    {
      if (Auth::user()->role_id == 1) {
        $updateNote = Notification::where('id',$notification->id)
                                ->update([
                                  'subject'=>$request->input('subject'),
                                  'body'=>$request->input('body'),
                                ]);
        if ($updateNote) {
          return redirect()->route('notifications.index')->with('success','message successfully updated');
        }else {
          return redirect()->route('notifications.index')->with('error',' Error can not edit message ' );
        }
      }else {
        return view('auth.login');
      }
    }
    public function sendnote($id){
      if (Auth::user()->role_id == 1) {
        $users = User::all();
        $note = Notification::where('id',$id)->first();
        return view('notifications.send',['notification'=>$note, 'users'=>$users]);
      }else {
        return view('auth.login');
      }
    }
    // sending notifications to users

    public function sendToUser(Request $request)
    {
      if(Auth::user()->role_id == 1) {
        $users = $request->get('recipients');
        $note = Notification::where('id', $request->input('note_id'))->first();
        foreach ($users as $user) {
          //check if contact already exist
          $notificationUser = DB::table('notification_user')->where('notification_id', $note->id)
                                                    ->where('user_id', $user)
                                                    ->exists();
          if (!$notificationUser) {
            $note->users()->attach($user);
          }

        }
        return redirect()->route('notifications.index')->with('success','notification successfully sent');

      }else {
        return view(auth.login);
      }
    }
    //remove notification
    public function removeNotification(Request $request)
    {
      if(Auth::check()) {
        $user_id = Auth::user()->id;
        $note = Notification::where('id', $request->input('note_id'))->first();
        if ($note) {
          $note->users()->detach($user_id);
          return redirect()->route('inbox');
        }
      }else {
        return view(auth.login);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification $notification)
    {
      if (Auth::user()->role_id == 1) {
        // deletes a user account completely
        $deleteNote = Notification::where('id', $notification->id)
                            ->delete();
        if ($deleteNote){
            return redirect()->route('notifications.index')->with('success','message successfully deleted');
        }else{
            return redirect()->route('notifications.index')->with('error',"Error can't delete message");
        }
      }
    }
}
