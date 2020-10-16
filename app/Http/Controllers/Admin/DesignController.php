<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DesignGroups;
use App\Models\DesignTypes;
use App\Models\Designs;

class DesignController extends Controller
{
    public $data;
    public function designGroups()
    {
        $this->data['menu'] = 'design-group';
        $this->data['design_groups'] = DesignGroups::where('status_id', '!=', 3)->get();
        return view('admin.design-groups')->with($this->data);
    }
    
    public function designTypes($design_group_id)
    {   
        $this->data['menu'] = 'design-group';
        $this->data['design_types'] = DesignTypes::where('design_group_id', base64_decode($design_group_id))->get();
        $this->data['design_group_id'] = $design_group_id;
        return view('admin.design-types')->with($this->data);
    }

    public function designs($design_type_id, $design_group_id){
        $this->data['menu'] = 'design-group';
        $this->data['designs'] = Designs::where('design_type_id', base64_decode($design_type_id))->get();
        $this->data['design_type_id'] = $design_type_id;
        $this->data['design_group_id'] = $design_group_id;
        $this->data['design_type_slug'] = DesignTypes::where('id',base64_decode($design_type_id))->get(['slug'])->first()->slug;
        $this->data['design_type_title'] = DesignTypes::where('id',base64_decode($design_type_id))->get(['title'])->first()->title;
        return view('admin.designs')->with($this->data);
    }
}
