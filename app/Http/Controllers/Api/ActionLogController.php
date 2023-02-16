<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //set action log
    public function setActionLog(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];

        ActionLog::create($data);

        $viewData = ActionLog::select('*',DB::raw('COUNT(post_id) as user_count'))
        ->where('post_id',$request->post_id)
        ->groupBy('user_id')
        ->get();

        return response()->json([
            "viewData" => $viewData
        ]);
    }
}
