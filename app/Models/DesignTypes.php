<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignTypes extends Model
{
    //
    protected $table = 'design_types';

    public function designs(){
        return $this->hasMany('App\Models\Designs', 'design_type_id')->orderBy('title');
    }
}
