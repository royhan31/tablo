<?php

namespace App\Http\Controllers\API;

use App\News;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(News::all(), 'All news found', true), 200);
    }

    public function show($id)
    {
        $news = News::find($id);
        if (is_null($news)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($news, "a news found", true), 200);
        }
    }
}
