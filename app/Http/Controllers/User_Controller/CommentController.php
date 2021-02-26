<?php
namespace App\Http\Controllers\User_Controller;
use App\Http\Controllers\Controller;
use App\http\Models\Category;

use App\http\Models\Comment;
use App\http\Models\Post;
use App\http\Models\User;
use App\Events\NewComment;  //add
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotifyOwner;  //add
use Illuminate\Support\Facades\Notification;
class CommentController extends Controller
{

    public function store(Request $request)
    {
        $comment = Comment::create([
            'body'=>$request->body,
            'user_id'=> Auth::id(),
            'post_id'=>$request->post_id
        ]);

        //event(new NewComment($comment->user,$comment));   // use event or broadcast
        broadcast(new NewComment($comment->user,$comment))->toOthers();  //for message not duplicate

        $post = Post::with('user')->find($comment->post_id);
        $post_owner = $post->user;
        ## meaning of if    if any user itself not create post can recieve comment notification
        //if($post_owner->id != $comment->user_id){
        //     $post_owner->notify(new NotifyOwner($comment,$post));
        // }
        //$commments = collect($comment)->toArray()->all();
        $user = User::get();
        if($post_owner->id != $comment->user_id){
         Notification::send($user ,new NotifyOwner($comment,$post)); //can use it but send to all users
        }
        return new CommentResource($comment);

     }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }









    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }


    public function update(Request $request, Comment $comment)
    {
        //
    }


    public function destroy(Comment $comment)
    {
        //
    }
}
