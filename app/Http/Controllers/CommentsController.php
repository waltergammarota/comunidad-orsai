<?php

namespace App\Http\Controllers;

use App\Databases\CommentsModel;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        CommentsModel::getCommentsData('financiacion-la-uruguaya');
    }
}
