<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QueryPageController extends Controller
{
    public function __invoke()
    {
        return view('admin.query.index');
    }
}
