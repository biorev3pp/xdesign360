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
                            <li class="breadcrumb-item"><a href="{{route('design-types')}}">Cabinet</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('designs')}}">Designs</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right">
                <a href="javascript:;" onclick="designModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
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
                    <h4 class="card-title text-uppercae"><b>Alpina White</b>
                        <div class="heading-elements">
                            <span class="badge badge-success text-uppercase">active</span>
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="d-flex justify-content-center" style="position:relative;">
                        <img class="img-fluid" src="{{asset('media/uploads/cabinet/alpina-white-cabinetry-door-sample-1_2.jpg')}}">
                        <div class="heading-elements" style="position:absolute; bottom:0px; left:10px">
                            <span class="badge badge-success text-uppercase">default</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><b>Price:</b> <span>$1,200</span> </p>
                        <p class="card-text"><b>Material:</b> <span>Wood</span> </p>
                        <p class="card-text"><b>Manufacturer:</b> <span>John Doe</span> </p>
                        <p class="card-text"><b>Product ID:</b> <span>66445</span> </p>
                    </div>
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: 06.07.2020</span>
                    <span class="float-right">
                        <a href="javascript:;" onclick="designModal(true)" data-toggle="tooltip" title="Edit Design Group" class="text-dark mr-25"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal()" data-toggle="tooltip" title="Delete Design Group" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercae"><b>Black</b>
                        <div class="heading-elements">
                            <span class="badge badge-success text-uppercase">active</span>
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="d-flex justify-content-center" style="position:relative;">
                        <img class="img-fluid" src="{{asset('media/uploads/cabinet/sdge-fabuwood-allure_1.jpg')}}">
                    </div>
                    <div class="card-body">
                        <p class="card-text"><b>Price:</b> <span>$500</span> </p>
                        <p class="card-text"><b>Material:</b> <span>Wood</span> </p>
                        <p class="card-text"><b>Manufacturer:</b> <span>John Doe</span> </p>
                        <p class="card-text"><b>Product ID:</b> <span>66445</span> </p>
                    </div>
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: 06.07.2020</span>
                    <span class="float-right">
                        <a href="javascript:;" onclick="designModal(true)" data-toggle="tooltip" title="Edit Design Group" class="text-dark mr-25"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal()" data-toggle="tooltip" title="Delete Design Group" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="addDesignModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:50rem;">
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
                        <label class="text-uppercase m-0">Title</label>
                        <input name="title" class="form-control border" type="text" placeholder="Enter title" required>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label class="text-uppercase">Price</label>
                            <input name="price" class="form-control border" type="number" placeholder="Enter price" required min="0" max="10000">
                        </div>
                        <div class="col">
                            <label class="text-uppercase">Material</label>
                            <input name="material" class="form-control border" type="text" placeholder="Enter material" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label class="text-uppercase">Manufacturer</label>
                            <input name="manufacturer" class="form-control border" type="text" placeholder="Enter manufacturer" required>
                        </div>
                        <div class="col">
                            <label class="text-uppercase">Product ID</label>
                            <input name="product_id" class="form-control border" type="text" placeholder="Enter product id" required>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-wrap justify-content-start">
                        <div class="mr-2">
                            <label for="image" class="text-uppercase ml-0">Thumbnail/Icon</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="file1" class="d-none" onchange="readUrl(this)">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file1"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-uppercase ml-0">View 1 Base Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="file2" class="d-none" onchange="readUrl(this)">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file2"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-uppercase ml-0">View 2 Base Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="file3" class="d-none" onchange="readUrl(this)">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file3"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div>
                            <label for="image" class="text-uppercase ml-0">Open View Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="file4" class="d-none" onchange="readUrl(this)">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="file4"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-inline-block text-uppercase m-0">Is Default </label>
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="is_default" class="custom-control-input" id="isDefaultYes" value="1">
                            <label class="custom-control-label" for="isDefaultYes">Yes</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio"name="is_default" class="custom-control-input" id="isDefaultNo" value="0">
                            <label class="custom-control-label" for="isDefaultNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-inline-block text-uppercase m-0">Activate </label>
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
    function designModal(editable){
        var modal = $('#addDesignModal');
        if(editable == true){
            modal.find('.modal-title').text('Edit Design')
            modal.find('.modal-footer button').text('Save Changes')
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Design')
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