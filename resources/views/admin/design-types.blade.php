@extends('layouts.inner')
@section('content')
<div class="content-header row">
    <div class="content-header-light col-12">
        <div class="row align-items-center justify-content-between pr-3 pl-3">
            <div class="content-header-left mb-2 pl-0">
                <h3 class="content-header-title">Design Groups</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('design-group')}}">Kitchen</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('design-types')}}">Design Types</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right">
                <a href="javascript:;" onclick="designTypeModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
                    <i class="ft-plus"></i>
                    <span>Add New</span>
                </a>  
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercae"><b>Cabinet</b>
                        <div class="heading-elements">
                            <span class="badge badge-success text-uppercase">active</span>
                        </div>
                    </h4>
                </div>
                <div class="card-content d-flex justify-content-center">
                    <img class="img-fluid" src="{{asset('media/cabinet_icon.png')}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: 06.07.2020</span>
                    <span class="float-right">
                        <a href="{{route('designs')}}" data-toggle="tooltip" title="View Designs" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                        <a href="javascript:;" onclick="designTypeModal(true)" data-toggle="tooltip" title="Edit Design Type" class="text-dark mr-25"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal();" data-toggle="tooltip" title="Delete Design Type" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercae"><b>Backsplash</b>
                        <div class="heading-elements">
                            <span class="badge badge-success text-uppercase">active</span>
                        </div>
                    </h4>
                </div>
                <div class="card-content d-flex justify-content-center">
                    <img class="img-fluid" src="{{asset('media/backsplash_icon.png')}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: 06.07.2020</span>
                    <span class="float-right">
                        <a href="{{route('designs')}}" data-toggle="tooltip" title="View Designs" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                        <a href="javascript:;" onclick="designTypeModal(true)" data-toggle="tooltip" title="Edit Design Type" class="text-dark mr-25"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal();" data-toggle="tooltip" title="Delete Design Type" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercae"><b>Countertop</b>
                        <div class="heading-elements">
                            <span class="badge badge-success text-uppercase">active</span>
                        </div>
                    </h4>
                </div>
                <div class="card-content d-flex justify-content-center">
                    <img class="img-fluid" src="{{asset('media/countertop_icon.png')}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: 06.07.2020</span>
                    <span class="float-right">
                        <a href="{{route('designs')}}" data-toggle="tooltip" title="View Designs" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                        <a href="javascript:;" onclick="designTypeModal(true)" data-toggle="tooltip" title="Edit Design Type" class="text-dark mr-25"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal();" data-toggle="tooltip" title="Delete Design Type" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="addDesignTypeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h3 class="modal-title"> Add New Design Type</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ft-x text-secondary"></i>
                </button>
            </div>
            <form id="designForm">
                <div class="modal-body">
                    <div class="form-group">
                    <label class="text-uppercase">Title</label>
                        <input name="title" class="form-control border" type="text" placeholder="Enter title" required>
                    </div>
                    <div class="form-group">
                        <label for="image" class="text-uppercase mb-1">Thumbnail/Icon</label>
                        <figure class="position-relative w-150 mb-0">
                            <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                            <input type="file" id="file1" class="d-none" onchange="readUrl(this)">
                            <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file1"> <i class="ft-image"></i> Choose Image</label>
                        </figure>
                    </div>
                    <div class="form-group">
                        <label class="d-inline-block mr-1 text-uppercase m-0">Activate </label>
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="status" class="custom-control-input" id="yes1" value="publish">
                            <label class="custom-control-label" for="yes1">Yes</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio"name="status" class="custom-control-input" id="no1" value="pending">
                            <label class="custom-control-label" for="no1">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-inline-block mr-1 text-uppercase m-0">Can Open</label>
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="can_open" class="custom-control-input" id="yes2" value="1">
                            <label class="custom-control-label" for="yes2">Yes</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio"name="can_open" class="custom-control-input" id="no2" value="0">
                            <label class="custom-control-label" for="no2">No</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark text-white m-0">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function designTypeModal(editable){
        var modal = $('#addDesignTypeModal');
        if(editable == true){
            modal.find('.modal-title').text('Edit Design Type')
            modal.find('.modal-footer button').text('Save Changes')
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Design Type')
            modal.find('.modal-footer button').text('Add New')
            modal.find('.img-thumbnail').attr('src', '{{asset("media/placeholder.jpg")}}')  
            form.reset();
            modal.modal('show');
        }
    }
    function readUrl(input) {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $(input).prev().attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteSwal(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    }
</script>
@endpush