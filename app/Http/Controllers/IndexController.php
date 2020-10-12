<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesignTypes;
use App\Models\DesignGroups;
use App\Models\Designs;

class IndexController extends Controller
{
    public $data;
    public function index()
    {   
        $sources1 = [];
        $sources2 = [];
        $this->data['design_group'] = $design_group = DesignGroups::first();
        $design_types = DesignTypes::where(['status_id' => 1, 'design_group_id' => 1])->with('designs');
        $this->data['design_types'] = $design_types->get();
        if($design_group->base_image_view1)
        {
            $sources1['base_image_view1'] = asset('media/uploads/'.$design_group->base_image_view1);
        }
        foreach($design_types->orderBy('priority')->get() as $design_type)
        {
            $design = Designs::where([
                'design_type_id'    => $design_type->id,
                'status_id'         => 1,
                'is_default'        => 1
                ])->first();
            if($design->image_view1)
            {
                $sources1[$design_type->slug] = asset('media/uploads/'.$design_type->title.'/'.$design->image_view1);
            }
        }
        if($design_group->base_image_view2)
        {
            $sources2['base_image_view2'] = asset('media/uploads/'.$design_group->base_image_view2);
        }
        foreach($design_types->orderBy('priority')->get() as $design_type)
        {
            $design = Designs::where([
                'design_type_id'    => $design_type->id,
                'status_id'         => 1,
                'is_default'        => 1
                ])->first();
            if($design->image_view2)
            {
                $sources2[$design_type->slug] = asset('media/uploads/'.$design_type->title.'/'.$design->image_view2);
            }
        }
        $this->data['sources1'] = $sources1;
        $this->data['sources2'] = $sources2;
        return view('index')->with($this->data);
    }
}
