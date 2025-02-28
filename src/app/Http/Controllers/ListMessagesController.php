<?php

namespace App\Http\Controllers;

use App\ViewModels\GetMessages;
use Illuminate\Http\Request;

class ListMessagesController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = new GetMessages($request->get('page', 1));

        return response()->json($model->messages(), 200);
    }
}
