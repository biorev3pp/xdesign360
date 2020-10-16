<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Designs;
use App\Models\DesignGroups;

class DesignController extends Controller
{
    public function index($design_id)
    {
        $designs = Designs::where('id', $design_id)->first();
        return $designs;
    }

    public function createDesignGroup(Request $request)
    {
        $destination_path = public_path('media/uploads');
        if($request->file('view1_base_image'))
        {
            $view1_file = $request->file('view1_base_image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
        }

        else
        {
            $view1_name = null;
        }

        if($request->file('view2_base_image'))
        {
            $view2_file = $request->file('view2_base_image');
            $view2_name = $view2_file->getClientOriginalName();
            $view2_file->move($destinationPath, $view2_name);
        }

        else
        {
            $view2_name = null;
        }

        if($request->title)
        {
            $design_group = DesignGroups::create([
                'title'             => $request->title,
                'base_image_view1'  => ($view1_name)?$view1_name:'',
                'base_image_view2'  => ($view2_name)?$view2_name:'',
                'status_id'         => $request->status
            ]);
            return $design_group;
        }
    }

    public function modifyDesignGroup(Request $request)
    {
        $design_group = DesignGroups::find($request->design_group_id);
        
        if($request->title)
        {
            $design_group->title = $request->title;
        }
        
        $design_group->status_id = $request->status;

        $destination_path = public_path('media/uploads');
        if($request->file('view1_base_image'))
        {
            $view1_file = $request->file('view1_base_image');
            $view1_name = $view1_file->getClientOriginalName();
            $view1_file->move($destination_path, $view1_name);
            $design_group->base_image_view1 = $view1_name;
        }

        if($request->file('view2_base_image'))
        {
            $view2_file = $request->file('view2_base_image');
            $view2_name = $view2_file->getClientOriginalName();
            $view2_file->move($destination_path, $view2_name);
            $design_group->base_image_view2 = $view2_name;
        }

        $design_group->save();
        return $design_group;
    }
}
