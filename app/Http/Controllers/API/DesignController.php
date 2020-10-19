<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Designs;
use App\Models\DesignGroups;
use App\Models\DesignTypes;

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

    public function deleteDesignGroup(Request $request){
        $design_group = DesignGroups::find($request->design_group_id);
        $design_group->status_id = 2;
        $design_group->save();  
    }

    public function createDesignType(Request $request)
    {
        $destination_path = public_path('media');
        if($request->file('thumbnail_image'))
        {
            $thumbnail_file = $request->file('thumbnail_image');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
        }

        else
        {
            $thumbnail_name = null;
        }

        if($request->title)
        {
            $design_type = DesignTypes::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'design_group_id'   => $request->design_group_id,
                'thumbnail'         => ($thumbnail_name)?$thumbnail_name:'',
                'status_id'         => $request->status,
                'can_open'          => $request->can_open
            ]);
            return $design_type;
        }
    }

    public function modifyDesignType(Request $request)
    {
        $design_type = DesignTypes::find($request->design_type_id);
        
        if($request->title)
        {
            $design_type->title = $request->title;
            $design_type->slug = Str::slug($request->title, '-');   
        }
        
        $design_type->status_id = $request->status;
        $design_type->can_open = $request->can_open;

        $destination_path = public_path('media');
        if($request->file('thumbnail_image'))
        {
            $thumbnail_file = $request->file('thumbnail_image');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
            $design_type->thumbnail = $thumbnail_name;
        }

        $design_type->save();
        return $design_type;
    }
    
    public function deleteDesignType(Request $request){
        $design_type = DesignTypes::find($request->design_type_id);
        $design_type->status_id = 2;
        $design_type->save();  
    }

    public function createDesign(Request $request)
    {   
        $destination_path = public_path('media/uploads/'.$request->design_type_slug);

        if($request->file('thumbnail'))
        {
            $thumbnail_file = $request->file('thumbnail');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
        }

        else
        {
            $thumbnail_name = null;
        }

        if($request->file('view1_image'))
        {
            $view1_image_file = $request->file('view1_image');
            $view1_image_name = $view1_image_file->getClientOriginalName();
            $view1_image_file->move($destination_path, $view1_image_name);
        }

        else
        {
            $view1_image_name = null;
        }

        if($request->file('view2_image'))
        {
            $view2_image_file = $request->file('view2_image');
            $view2_image_name = $view2_image_file->getClientOriginalName();
            $view2_image_file->move($destination_path, $view2_image_name);
        }

        else
        {
            $view2_image_name = null;
        }

        if($request->file('open_view_image'))
        {
            $open_view_image_file = $request->file('view2_image');
            $open_view_image_name = $open_view_image_file->getClientOriginalName();
            $open_view_image_file->move($destination_path, $open_view_image_name);
        }

        else
        {
            $open_view_image_name = null;
        }

        if($request->title)
        {   
            $design = Designs::create([
                'title'             => $request->title,
                'slug'              => Str::slug($request->title, '-'),
                'design_group_id'   => base64_decode($request->design_group_id),
                'design_type_id'    => base64_decode($request->design_type_id),
                'thumbnail'         => ($thumbnail_name)?$thumbnail_name:'',
                'image_view1'       => ($view1_image_name)?$view1_image_name:'',
                'image_view2'       => ($view2_image_name)?$view2_image_name:'',
                'open_view_image'   => ($open_view_image_name)?$open_view_image_name:'',
                'is_default'        => $request->is_default,
                'price'             => $request->price,
                'material'          => $request->material,
                'manufacturer'      => $request->manufacturer,
                'product_id'        => $request->product_id,
                'status_id'         => $request->status
            ]);
        }

        if($design->is_default == 1)
        {
            Designs::where([
                'is_default'        => 1,
                'design_type_id'    => $design->design_type_id
            ])->update([
                'is_default' => 0
            ]);
        }
        return $design;
    }

    public function modifyDesign(Request $request)
    {   
        $design = Designs::find($request->design_id);
        if($request->title)
        {
            $design->title = $request->title;
            $design->slug = Str::slug($request->title, '-');   
        }

        if($request->price)
        {
            $design->price = $request->price;
        }

        if($request->material)
        {
            $design->material = $request->material;
        }
        
        if($request->manufacturer)
        {
            $design->manufacturer = $request->manufacturer;
        }

        if($request->product_id)
        {
            $design->product_id = $request->product_id;
        }

        if($request->is_default == 1)
        {
            Designs::where([
                'is_default'        => 1,
                'design_type_id'    => base64_decode($request->design_type_id)
            ])->update([
                'is_default' => 0
            ]);
            $design->is_default = $request->is_default;
        }

        $design->status_id = $request->status;

        $destination_path = public_path('media/uploads/'.$request->design_type_slug);
        if($request->file('thumbnail'))
        {
            $thumbnail_file = $request->file('thumbnail');
            $thumbnail_name = $thumbnail_file->getClientOriginalName();
            $thumbnail_file->move($destination_path, $thumbnail_name);
            $design->thumbnail = $thumbnail_name;
        }

        if($request->file('view1_image'))
        {
            $view1_image_file = $request->file('view1_image');
            $view1_image_name = $view1_image_file->getClientOriginalName();
            $view1_image_file->move($destination_path, $view1_image_name);
            $design->image_view1 = $view1_image_name;
        }

        if($request->file('view2_image'))
        {
            $view2_image_file = $request->file('view2_image');
            $view2_image_name = $view2_image_file->getClientOriginalName();
            $view2_image_file->move($destination_path, $view2_image_name);
            $design->image_view2 = $view2_image_name;
        }

        if($request->file('open_view_image'))
        {
            $open_view_image_file = $request->file('view2_image');
            $open_view_image_name = $open_view_image_file->getClientOriginalName();
            $open_view_image_file->move($destination_path, $open_view_image_name);
            $design->open_view_image = $open_view_image_name;
        }

        $design->save();
        return $design;
    }

    public function deleteDesign(Request $request){
        $design = Designs::find($request->design_id);
        $design->status_id = 2;
        $design->save();  
    }
}
