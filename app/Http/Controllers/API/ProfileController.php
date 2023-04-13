<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public $successStatus = 200;
    
    public function details()
    {
        try {
            $count = User::where('id', Auth::user()->id)->count();
            if ($count > 0) {
                $user = User::where('id', Auth::user()->id)->first();
                return response()->json(['data' => $user, 'status' => true, 'message' => 'Details found successfully.'], $this->successStatus);
            } else {
                return response()->json(['messager' => 'No detail found!', 'status' => false], 401);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'something went wrong' , 'status' => false], 401);
        }    
    }
}
