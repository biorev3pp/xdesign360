<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Designs;

class DesignController extends Controller
{
    public function index($design_id){
        $designs = Designs::where('id', $design_id)->first();
        return $designs;
    }
}
