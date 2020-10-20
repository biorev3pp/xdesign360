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
        $this->data['design_groups'] = DesignGroups::where('status_id', '!=', 2)->get();
        return view('admin.design-groups')->with($this->data);
    }
    
    public function designTypes($design_group_id)
    {   
        $this->data['menu'] = 'design-group';
        $this->data['design_types'] = DesignTypes::where('design_group_id', base64_decode($design_group_id))->where('status_id', '!=', 2)->get();
        $this->data['design_group_id'] = $design_group_id;
        $this->data['design_group_title'] = DesignGroups::where('id', base64_decode($design_group_id))->get(['title'])->first()->title;
        return view('admin.design-types')->with($this->data);
    }

    public function designs($design_type_id, $design_group_id){
        $this->data['menu'] = 'design-group';
        $this->data['designs'] = Designs::where('design_type_id', base64_decode($design_type_id))->where('status_id', '!=', 2)->get();
        $this->data['design_type_id'] = $design_type_id;
        $this->data['design_group_id'] = $design_group_id;
        $design_group = DesignGroups::where('id',base64_decode($design_group_id))->get(['title', 'view1_title', 'view2_title'])->first();
        $this->data['design_group_title'] = $design_group->title;
        $this->data['design_group_view1_title'] = $design_group->view1_title;
        $this->data['design_group_view2_title'] = $design_group->view2_title;
        $design_type = DesignTypes::where('id',base64_decode($design_type_id))->get(['slug', 'title', 'can_open'])->first();
        $this->data['design_type_slug'] = $design_type->slug;
        $this->data['design_type_title'] = $design_type->title;
        $this->data['design_type_can_open'] = $design_type->can_open;

        return view('admin.designs')->with($this->data);
    }
}
