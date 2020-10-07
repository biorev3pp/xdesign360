<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesignTypes;

class IndexController extends Controller
{
    public $data;
    public function index()
    {   
        $this->data['design_types'] = DesignTypes::where('status_id', 1)->with('designs')->get();
        return view('index')->with($this->data);
    }
}
