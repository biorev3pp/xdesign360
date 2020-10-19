<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DesignGroups;

class DashboardController extends Controller
{
    public $data;
    public function index(){
        $this->data['menu'] = 'home';
        $this->data['design_groups_count'] = DesignGroups::where('status_id' ,'!=', 2)->count();
        return view('admin.dashboard')->with($this->data);
    }
}
