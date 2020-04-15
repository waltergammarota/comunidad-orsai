<?php


namespace App\Http\Controllers\Contest;

use App\Controllers\CreateContestApplicationController;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class ContestApplication extends Controller
{
    public function create(Request $request)
    {
        $cpaData = $request->all();
        $cpaController = new CreateContestApplicationController(
            $cpaData,
            $request
        );
        $cpa = $cpaController->execute();
        return response()->json(["id" => $cpa->getId()], 200);
    }
}
