@extends('layouts.inner')
@section('content')
<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row align-items-center">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <h3 class="content-header-title">Dashboard</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-3 col-12">
                <div class="float-md-right pt-20">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper row">
    <div class="content-body col-lg-3 col-md-6 mb-1">
        <div class="card-content">
            <a href="{{route('design-group')}}">
                <div class="card-body" style="background: #fff;box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);">
                    <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 style="color:#464855">{{$design_groups_count}}</h3>
                                <h6 style="font-size: 1.2rem;">Design Groups</h6>
                            </div>
                            <div>
                                <i class="ft-clipboard" style="font-size:3rem;"></i>
                            </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
