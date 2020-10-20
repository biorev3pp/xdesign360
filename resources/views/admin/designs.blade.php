@extends('layouts.inner')
@section('content')
<div class="content-header d-flex flex-wrap justify-content-between align-items-center bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Design Groups</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item text-capitalize"><a href="{{route('design-group')}}">{{$design_group_title}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('design-types', ['design_group_id' => $design_group_id])}}" class="text-capitalize">{{$design_type_title}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Designs</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right">
        <a href="{{route('design-types', ['design_group_id' => $design_group_id])}}" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
            <i class="ft-arrow-left"></i>
            <span>Back</span>
        </a>
        <a href="javascript:;" onclick="designModal(false)" class="btn btn-secondary square btn-min-width waves-effect waves-light box-shadow-2 px-2 standard-button"> 
            <i class="ft-plus"></i>
            <span>Add New</span>
        </a>   
    </div>
</div>
<div class="content-wrapper">
    <div class="row">
        @foreach($designs as $design)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="card" id="card{{$design->id}}">
                <div class="card-header">
                    <h4 class="card-title text-capitalize"><b>{{$design->title}}</b>
                        <div class="heading-elements">
                            @if($design->status_id == 1)
                            <span class="badge badge-success text-uppercase">active</span>
                            @elseif($design->status_id == 0)
                            <span class="badge badge-danger text-uppercase">deactive</span>
                            @endif
                        </div>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="d-flex justify-content-center" style="position:relative;">
                        <img class="img-fluid" src="{{asset('media/uploads/'.$design_type_slug.'/'.$design->thumbnail)}}">
                        <div class="default-badge">
                            @if($design->is_default == 1)
                            <div style="position:absolute; bottom:0px; left:10px">
                                <span class="badge badge-info text-uppercase">default</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-capitalize"><b>Price:</b> <span>${{number_format($design->price)}}</span> </p>
                        <p class="card-text text-capitalize"><b>Material:</b> <span>{{$design->material}}</span> </p>
                        <p class="card-text text-capitalize"><b>Manufacturer:</b> <span>{{$design->manufacturer}}</span> </p>
                        <p class="card-text text-capitalize"><b>Product ID:</b> <span>{{$design->product_id}}</span> </p>
                    </div>
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <span class="float-left">Updated On: <span>{{date('d-m-Y',strtotime($design->updated_at))}}</span></span>
                    <span class="float-right">
                        <a href="javascript:;" onclick="updateDefault({{$design->id}})" data-toggle="tooltip" title="Make Default" class="text-dark mr-25"> <i class="ft-check-square"></i> </a>
                        <a href="javascript:;" onclick="designModal(true, {{$design->id}}, '{{$design->title}}', '{{$design->thumbnail}}', '{{$design->image_view1}}', '{{$design->image_view2}}', '{{$design->open_view_image}}', {{$design->price}}, '{{$design->material}}', '{{$design->manufacturer}}', '{{$design->product_id}}', {{$design->status_id}})" data-toggle="tooltip" title="Edit Design" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                        <a href="javascript:;" onclick="deleteSwal({{$design->id}})" data-toggle="tooltip" title="Delete Design" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
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
                        <input name="title" id="title" class="form-control border" type="text" placeholder="Enter title" required>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label class="text-uppercase">Price</label>
                            <input name="price" id="price" class="form-control border" type="number" placeholder="Enter price" required min="0" max="10000">
                        </div>
                        <div class="col">
                            <label class="text-uppercase">Material</label>
                            <input name="material" id="material" class="form-control border" type="text" placeholder="Enter material" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label class="text-uppercase">Manufacturer</label>
                            <input name="manufacturer" id="manufacturer" class="form-control border" type="text" placeholder="Enter manufacturer" required>
                        </div>
                        <div class="col">
                            <label class="text-uppercase">Product ID</label>
                            <input name="product_id" id="productId" class="form-control border" type="text" placeholder="Enter product id" required>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-wrap justify-content-start">
                        <div class="mr-2">
                            <label for="image" class="text-uppercase ml-0">Thumbnail/Icon</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="thumbnailImage" class="d-none" onchange="readUrl(this,'thumbnail')">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="thumbnailImage"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-uppercase ml-0">{{$design_group_view1_title}} view base image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="imageView1" class="d-none" onchange="readUrl(this, 'view1')">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="imageView1"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-uppercase ml-0">{{$design_group_view2_title}} view base image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="imageView2" class="d-none" onchange="readUrl(this, 'view2')">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="imageView2"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        @if($design_type_can_open == 1)
                        <div>
                            <label for="image" class="text-uppercase ml-0">Open View Image</label>
                            <figure class="position-relative w-150 mb-0">
                                <img src="{{asset('media/placeholder.jpg')}}" class="img-thumbnail">
                                <input type="file" id="openViewImage" class="d-none" onchange="readUrl(this, 'openView')">
                                <label class="btn btn-sm btn-secondary in-block m-0" style="padding:0.59375rem 1rem" for="openViewImage"> <i class="ft-image"></i> Choose Image</label>
                            </figure>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="d-inline-block text-uppercase m-0">Activate </label>
                        <div class="d-inline-block custom-control custom-radio mr-1">
                            <input type="radio" name="status" class="custom-control-input" id="yes1" value="1">
                            <label class="custom-control-label" for="yes1">Yes</label>
                        </div>
                        <div class="d-inline-block custom-control custom-radio">
                            <input type="radio"name="status" class="custom-control-input" id="no1" value="0" checked>
                            <label class="custom-control-label" for="no1">No</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitButton" onclick="submitForm(true)" data-type-id="{{$design_type_id}}" data-group-id="{{$design_group_id}}" data-type-slug="{{$design_type_slug}}" class="btn btn-dark text-white m-0">
                        <span class="button-text"> Save Changes </span>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const designTypeCanOpen = {{$design_type_can_open}};
    const path = '{{asset("media/uploads/".$design_type_slug)}}';
    const date = new Date();
    const view1Title = '{{$design_group_view1_title}}';
    const view2Title = '{{$design_group_view2_title}}';
    let thumbnail = null, view1Image = null, view2Image = null, isChange = false;
    if(designTypeCanOpen == 1){
        let openViewImage = null;
    }
    //Price Formatter
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    function designModal(...values){
        isChange = false;
        thumbnail = null;
        view1Image = null;
        view2Image = null;
        if(designTypeCanOpen == 1){
            openViewImage = null;
        }

        var modal = $('#addDesignModal');
        if(values[0] == true){
            modal.find('.modal-title').text('Edit Design')
            modal.find('#submitButton .button-text').text('Save Changes')
            const statusRadioButtons = $('#designForm input[name="status"]');
            $.each(statusRadioButtons, function(){
                if($(this).val() == values[11]){
                    $(this).prop('checked', true);
                }
            });
            modal.find('#title').val(values[2]);
            modal.find('#price').val(values[7]);
            modal.find('#material').val(values[8]);
            modal.find('#manufacturer').val(values[9]);
            modal.find('#productId').val(values[10]);
            if(values[3] != ""){
                modal.find('#thumbnailImage').prev().attr('src', `${path}/${values[3]}`);
            }
            if(values[4] != ""){
                modal.find('#imageView1').prev().attr('src', `${path}/${values[4]}`);
            }
            if(values[5] != ""){
                modal.find('#imageView2').prev().attr('src', `${path}/${values[5]}`);
            }
            if(values[6] != ""){
                modal.find('#openViewImage').prev().attr('src', `${path}/${values[5]}`);
            }
            modal.find('#submitButton').attr('data-id', values[1]);
            modal.find('#submitButton').attr('onclick', 'submitForm(true)');
            modal.modal('show');
        }
        else{
            var form = document.getElementById('designForm');
            modal.find('.modal-title').text('Add New Design')
            modal.find('#submitButton .button-text').text('Add New')
            modal.find('.img-thumbnail').attr('src', '{{asset("media/placeholder.jpg")}}')
            modal.find('#submitButton').attr('data-id', '');
            modal.find('#submitButton').attr('onclick', 'submitForm(false)');
            form.reset();
            modal.modal('show');
        }
    }

    // Get FileType
    const fileType = (file) => {
        return file.type.split('/').pop().toLowerCase();
    }

    const imageValidation = () => {
        if(thumbnail == null){
            toastr.clear()
            toastr.error(`Thumbnail is required`);
            return false;
        }

        if (fileType(thumbnail) != "jpeg" && fileType(thumbnail) != "jpg" && fileType(thumbnail) != "png") {
            toastr.clear()
            toastr.error('Only jpeg, jpg, png formats are allowed for thumbnail');
            return false;
        }

        if(view1Image == null){
            toastr.clear()
            toastr.error(`${view1Title} view base image is required`);
            return false;
        }
        
        if (fileType(view1Image) != "jpeg" && fileType(view1Image) != "jpg" && fileType(view1Image) != "png") {
            toastr.clear()
            toastr.error(`Only jpeg, jpg, png formats are allowed for ${view1Title} view base image`);
            return false;
        }

        if(view2Image == null){
            toastr.clear()
            toastr.error(`${view2Title} view base image is required`);
            return false;
        }

        if (fileType(view2Image) != "jpeg" && fileType(view2Image) != "jpg" && fileType(view2Image) != "png") {
            toastr.clear()
            toastr.error(`Only jpeg, jpg, png formats are allowed for ${view2Title} view base image`);
            return false;
        }

        if(designTypeCanOpen == 1){
            if(openViewImage == null){
                toastr.clear()
                toastr.error('Open view image is required');
                return false;
            }

            if (fileType(openViewImage) != "jpeg" && fileType(openViewImage) != "jpg" && fileType(openViewImage) != "png") {
                toastr.clear()
                toastr.error('Only jpeg, jpg, png formats are allowed for open view base image');
                return false;
            }
        }
    }
    
    function submitForm(editable){
        const title = $('#title').val();
        const price = $('#price').val();
        const material = $('#material').val();
        const manufacturer = $('#manufacturer').val();
        const productId = $('#productId').val();
        const status = $('input[name="status"]:checked').val();
        const designTypeId = $("#submitButton").attr('data-type-id');
        const designTypeSlug = $("#submitButton").attr('data-type-slug');

        // Validations
        if(title == ''){
            toastr.clear()
            toastr.error('Title field is required');
            return false;
        }

        if(!(/^[A-Za-z ]+$/.test(title))){
            toastr.clear()
            toastr.error('Title field should only contain alphabets.');
            return false;
        }

        if(price == ''){
            toastr.clear()
            toastr.error('Price field is required');
            return false;
        }

        if(price < 0 && price > 100000){
            toastr.clear()
            toastr.error('Price should be between 0 and 100000');
            return false;
        }

        if(material == ''){
            toastr.clear()
            toastr.error('Material field is required');
            return false;
        }

        if(manufacturer == ''){
            toastr.clear()
            toastr.error('Manufacturer field is required');
            return false;
        }

        if(productId == ''){
            toastr.clear()
            toastr.error('Product Id field is required');
            return false;
        }

        if(editable == true){
            if(isChange == true){
                if(imageValidation() == false){
                    return false;
                }
            }
        }
        else{
            if(imageValidation() == false){
                return false;
            }
        }

        const formData = new FormData();

        formData.append('title', title);
        formData.append('price', price);
        formData.append('material', material);
        formData.append('manufacturer', manufacturer);
        formData.append('product_id', productId);
        formData.append('status', status);
        formData.append('thumbnail', thumbnail);
        formData.append('view1_image', view1Image);
        formData.append('view2_image', view2Image);
        if(designTypeCanOpen == 1){
            formData.append('open_view_image', openViewImage);
        }
        formData.append('design_type_id', designTypeId);
        formData.append('design_type_slug', designTypeSlug);

        $("#addDesignModal").find('#submitButton').addClass('disable');
        $("#addDesignModal").find('#submitButton .button-text').addClass('hide-button-text');
        $("#addDesignModal").find('#submitButton .spinner-border').addClass('show-spinner');

        if(editable == true){
            const designId = $("#submitButton").attr('data-id');
            formData.append('design_id', designId);

            $.ajax({
                type: 'post',
                url: '/api/edit-design',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    const parent = $(`#card${response.id}`);
                    parent.find('.card-title b').text(response.title);
                    parent.find('.card-content .img-fluid').attr('src',`${path}/${response.thumbnail}`);
                    parent.find('.card-body p:first-child span').text(formatter.format(response.price));
                    parent.find('.card-body p:nth-child(2) span').text(response.material);
                    parent.find('.card-body p:nth-child(3) span').text(response.manufacturer);
                    parent.find('.card-body p:nth-child(4) span').text(response.product_id);

                    if(response.status_id == 1){
                        parent.find('.heading-elements').html('<span class="badge badge-success text-uppercase">active</span>');
                    }
                    else if(response.status_id == 0){
                        parent.find('.heading-elements').html('<span class="badge badge-danger text-uppercase">deactive</span>');
                    }

                    parent.find('.card-footer span:first-child span').html(`${date.getDate(response.updated_at)}-${date.getMonth(response.updated_at)}-${date.getFullYear(response.updated_at)}`);

                    parent.find('.edit-button').attr('onclick', `designModal(true, ${response.id}, '${response.title}', '${response.thumbnail}', '${response.image_view1}', '${response.image_view1}', '${response.open_view_image}', ${response.price}, '${response.material}', '${response.manufacturer}', '${response.product_id}', ${response.status_id})`);
                    $('#addDesignModal').modal('hide');
                    $("#addDesignModal").find('#submitButton').removeClass('disable');
                    $("#addDesignModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addDesignModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
        else{
            const designGroupId = $("#submitButton").attr('data-group-id');
            formData.append('design_group_id', designGroupId);

            $.ajax({
                type: 'post',
                url: '/api/add-design',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    let card = null;
                    card = `<div class="col-xl-3 col-lg-4 col-sm-6">
                                <div class="card" id="card${response.id}">
                                    <div class="card-header">
                                        <h4 class="card-title text-capitalize"><b>${response.title}</b>
                                            <div class="heading-elements">
                                                ${(response.status_id == 1)?'<span class="badge badge-success text-uppercase">active</span>':'<span class="badge badge-danger text-uppercase">deactive</span>'}
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="d-flex justify-content-center" style="position:relative;">
                                            <img class="img-fluid" src="${path}/${response.thumbnail}">
                                            <div class="default-badge"></div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text text-capitalize"><b>Price:</b> <span>${response.price}</span> </p>
                                            <p class="card-text text-capitalize"><b>Material:</b> <span>${response.material}</span> </p>
                                            <p class="card-text text-capitalize"><b>Manufacturer:</b> <span>${response.manufacturer}</span> </p>
                                            <p class="card-text text-capitalize"><b>Product ID:</b> <span>${response.product_id}</span> </p>
                                        </div>
                                    </div>
                                    <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                        <span class="float-left">Updated On: ${date.getDate(response.updated_at)}-${date.getMonth(response.updated_at)}-${date.getFullYear(response.updated_at)}</span>
                                        <span class="float-right">
                                            <a href="javascript:;" onclick="updateDefault(${response.id})" data-toggle="tooltip" title="Make Default" class="text-dark mr-25"> <i class="ft-check-square"></i> </a>
                                            <a href="javascript:;" onclick="designModal(true, ${response.id}, '${response.title}', '${response.thumbnail}', '${response.image_view1}', '${response.image_view1}', '${response.open_view_image}', ${response.price}, '${response.material}', '${response.manufacturer}', '${response.product_id}', ${response.status_id})" data-toggle="tooltip" title="Edit Design" class="text-dark mr-25 edit-button"> <i class="ft-edit"></i> </a>
                                            <a href="javascript:;" onclick="deleteSwal(${response.id})" data-toggle="tooltip" title="Delete Design" class="text-dark mr-25"> <i class="ft-trash-2"></i> </a>
                                        </span>
                                    </div>
                                </div>
                            </div>`;
                    $('.content-wrapper .row').append(card);
                    $('#addDesignModal').modal('hide');
                    $("#addDesignModal").find('#submitButton .button-text').removeClass('hide-button-text');
                    $("#addDesignModal").find('#submitButton .spinner-border').removeClass('show-spinner');
                }
            });
        }
    }
    
    function readUrl(input, element) {
        if (input.files && input.files[0]) 
        {
            isChange = true;
            var reader = new FileReader();
            reader.onload = function (e) 
            {
                $(input).prev().attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
            switch(element){
                case 'thumbnail': 
                    thumbnail = input.files[0];
                    break;
                case 'view1': 
                    view1Image = input.files[0];
                    break;
                case 'view2': 
                    view2Image = input.files[0];
                    break; 
                case 'openView': 
                    openViewImage = input.files[0];
                    break;   
                default:
                    break;
            }
        }
    }

    function deleteSwal(designId){
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
                if(deleteDesign(designId) == true){
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            }
        })
    }

    function deleteDesign(id){
        let status = false;
        $.ajax({
            type: 'delete',
            url: '/api/delete-design',
            data: {design_id: id },
            success: function(){
                $(`#card${id}`).parent().remove();
                status = true;
            },
            error: function(error){
                status = false;
                toastr.error(error.responseJSON);
            }
        });
        return status;
    }

    function updateDefault(designId){
        $.ajax({
            type: 'put',
            url: '/api/update-default',
            data: {design_id: designId},
            success: function(){
                $(".default-badge").html('');
                $(`#card${designId}`).find('.default-badge').html(
                    `<div style="position:absolute; bottom:0px; left:10px">
                        <span class="badge badge-info text-uppercase">default</span>
                    </div>`);
            },
            error: function(error){
                toastr.error(error.responseJSON);
            }
        })
    }
</script>
@endpush