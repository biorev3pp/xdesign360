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
                            <li class="breadcrumb-item"><a href="{{route('design-group')}}">Design Groups</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right">
                <a href="javascript:;" onclick="designGroupModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
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
                    <h4 class="card-title text-uppercae"><b>Kitchen</b>
                        <div class="heading-elements">
                            <span class="badge badge-success text-uppercase">active</span>
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <img class="img-fluid" src="{{asset('media/uploads/base_image1.png')}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: 06.07.2020</span>
                    <span class="float-right">
                        <a href="{{route('design-types')}}" data-toggle="tooltip" title="View Design Types" class="text-dark mr-25"> <i class="ft-eye"></i> </a>
                        <a href="javascript:;" onclick="designGroupModal(true)" data-toggle="tooltip" title="Edit Design Group" class="text-dark mr-25"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal()" data-toggle="tooltip" title="Delete Design Group" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="addDesignGroupModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h3 class="modal-title"> Add New Design Group</h3>
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
                    <div class="form-group d-flex flex-wrap justify-content-start">
                        <div class="mr-2">
                            <label for="image" class="text-uppercase mb-1">View 1 Base Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="file1" class="d-none" onchange="readUrl(this)">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file1"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div>
                            <label for="image" class="text-uppercase mb-1">View 2 Base Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="file2" class="d-none" onchange="readUrl(this)">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file2"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
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
    function designGroupModal(editable){
        var modal = $('#addDesignGroupModal');
        if(editable == true){
            modal.find('.modal-title').text('Edit Design Group')
            modal.find('.modal-footer button').text('Save Changes')
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Design Group')
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