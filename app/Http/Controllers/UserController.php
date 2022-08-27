<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function markVoted(Request $request){
        try {
            DB::table('voters')->where('id',$request['id'])->update([
                'is_voted'=>1,
                'voted_date'=>date("y-m-d h:i:s"),
            ]);
            $data = [
                'status'=>true,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'status'=>false,
                'error'=>$e->getMessage(),
            ];
            return response()->json($data, 200);
        }
    }
    public function markNotVoted(Request $request){
        try {
            DB::table('voters')->where('id',$request['id'])->update([
                'is_voted'=>0,
                'voted_date'=>NULL,
            ]);
            $data = [
                'status'=>true,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data = [
                'status'=>false,
                'error'=>$e->getMessage(),
            ];
            return response()->json($data, 200);
        }
    }
    

}
