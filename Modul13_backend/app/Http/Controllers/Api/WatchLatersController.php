<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WatchLaters;
use App\Models\Contents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WatchLatersController extends Controller
{
  

     public function index()
     {
         $data = WatchLaters::inRandomOrder()->get();
 
         return response([
             'message' => 'All Watch Later Retrieved',
             'data' => $data
         ], 200);
     }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }
        $watchLaters = WatchLaters::where('id_user', $id)->get();
        return response()->json(['watch_laters' => $watchLaters]);
    }

    
    // public function store(Request $request)
    // {
    //     $storeData = $request->all();

    //     $validate = Validator::make($storeData, [
    //         'id_content' => 'required|numeric',
    //     ]);
    //     if ($validate->fails()) {
    //         return response(['message' => $validate->errors()], 400);
    //     }
    //     $idUser = Auth::user()->id;
    //     $user = User::find($idUser);
    //     if (is_null($user)) {
    //         return response([
    //             'message' => 'User Not Found'
    //         ], 404);
    //     }
    //     $content = Contents::find($storeData['id_content']);
    //     if (is_null($content)) {
    //         return response([
    //             'message' => 'Content Not Found'
    //         ], 404);
    //     }
    //     $storeData['id_user'] = $user->id;

    //     $isFound = WatchLaters::where('id_content', $storeData['id_content'])->where('id_user', $storeData['id_user'])->get();
    //     if (!$isFound->isEmpty()) {
    //         return response([
    //             'message' => 'Content already in your Watch Later List'
    //         ], 403);
    //     }

    //     $data = WatchLaters::create($storeData);
    //     return response([
    //         'message' => 'Watch Later Added Successfully',
    //         'data' => $data,
    //     ], 200);
    // }

    // public function destroy(string $id)
    // {
    //     $watchLater = WatchLaters::find($id);

    //     if (!$watchLater) {
    //         return response()->json(['error' => 'Watch later entry not found'], 404);
    //     }

    //     $watchLater->delete();

    //     return response()->json(['message' => 'Video deleted from watch later successfully']);
    // }

    // public function showWatchLaterbyUser($id)
    // {
    //     $user = User::find($id);
    //     if (!$user) {
    //         return response([
    //             'message' => 'User Not Found',
    //             'data' => null
    //         ], 404);
    //     }
    //     $data = WatchLaters::with('content', 'user')->where('id_user', $user->id)->get();
    //     return response([
    //         'message' => 'Contents of ' . $user->name . ' Retrieved',
    //         'data' => $data
    //     ], 200);
    // }
}
