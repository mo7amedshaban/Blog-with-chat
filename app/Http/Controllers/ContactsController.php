<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Events\NewMessage;
use App\Http\Models\Message;
use Illuminate\Http\Request;
use App\Events\UnreadMessages;
use App\Events\Unread_Messages;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{


    public function getContacts()
    {
        // get all users except the authenticated one
        $contacts = User::where('id', '!=', auth()->id())->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(DB::raw('`user_id` as sender_id, count(`user_id`) as messages_count'))
            ->where('reciever_id', auth()->id())
            ->where('read', false)
            ->groupBy('user_id')
            ->get();

        // add an unread key to each contact with the count of unread messages
         $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    public function fetchMessages($id)
    {
        //where(user_id,auth()->id());   if this user is sender

        // mark all messages with the selected contact as read
        Message::where('user_id', $id)->where('reciever_id', auth()->id())->update(['read' => true]);   // 1 is read

        $privateCommunication = Message::with('user')
            ->where(['user_id' => auth()->id(), 'reciever_id' => $id])
            ->orWhere(function ($query) use ($id) {
                $query->where(['user_id' => $id, 'reciever_id' => auth()->id()]);
            })
            ->get();

        return $privateCommunication;
    }



    public function sendMessage(Request $request)
    {
        $filename = '';
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('', 'chat');
        }

        $message = Message::create([
            'reciever_id' => $request->reciever_id,
            'text' => $request->text,
            'user_id' => auth()->id(),
            'image' => $filename,   //image is nullable
        ]);

        $unreadMessages = Message::with('user')->where('read',false)->where('user_id',auth()->id())->get();
        $unreadMessages2 = Message::with('user')->where('read',false)->where('reciever_id',auth()->id())->get();
        $allUnreadMessage = array_merge($unreadMessages->toArray(),$unreadMessages2->toArray());
        $message_count = collect($allUnreadMessage)->count();

        broadcast(new NewMessage($message->load('user'),$message_count))->toOthers();

        return $message;
    }


}
