<?php
namespace App\Http\Controllers\User_Controller;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Http\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{

// $hash1 = bcrypt('secret')
// $hash2 = bcrypt('secret')

// Hash::check('secret', $hash1)
// Hash::check('secret', $hash2)
// You should get true in both the cases of Hash::check.
    public function change_password(Request $request,$id){
        $request->validate([
            'password' => 'required|confirmed|min:6',

        ]);

        $user = User::where('id', $id)->update([
            'password'=>Hash::make($request->password),
            ]);
        return $user;
    }
    public function update_user_profile(Request $request , $id){
        try {
            $request->validate([
                'username' => 'required',

            ]);

            $filename = '';
            if ($request->hasFile('image')) {
                $filename = $request->file('image')->store('', 'user');
                User::where('id', $id)
            ->update([
                 'profile_img' => $filename,
            ]);
            }


            $user = User::where('id', $id)->update([
            'username'=>$request->username,
            'phone'=>$request->phone,
            'email'=>$request->email,
            ]);
            return $user;
        }catch(\Exception $ex){
            return $ex;
        }
    }




    public function register_user(RegisterRequest $request)
    {

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'profile_img' => 'default_image.png',
            'password' => bcrypt($request->password),
            //'password_confirmation'=>bcrypt($request->password_confirmation)
        ]);

        $user->token = $user->createToken('register')->plainTextToken;

        return response()->json($user);
    }


    public function login_user(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $user->token = $user->createToken('loginUser')->plainTextToken;


       return response()->json($user);
    }

    public function details()
    {
        // return current user only
        return response()->json(['user' => auth()->user()], 200);
    }



    //notifications    , unreadNotification     this is realtion ships
    public function getUnreadNotifications(){
        $notifications = Auth::user()->unreadNotifications;
        return response()->json($notifications);
    }



    public function getAllNotifications(){
        $notifications = Auth::user()->notifications;
        return response()->json($notifications);
    }
    // public function markNotificationAsRead(Request $request){
    //     $notification = Auth::user()->notifications->where('id',$request->id)->first();
    //     $notification->markAsRead();
    //     return response()->json(['msg'=>'ok']);
    // }

}
