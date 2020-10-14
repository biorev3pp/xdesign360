<div class="sidemenu custom-scroll scroll-width-thin d-flex flex-column justify-content-between" id="sideMenu">
    <div>
        <div class="toggle-btn">
            <input type="checkbox" class="cb-value"/>
            <span class="round-btn"></span>
        </div>
        <div class="design-options-wrapper">
            @foreach($design_types as $design_type)
            <div class="design-icons-wrap image-icons-wrap">
                <div class="design-icons back-image" style="background: url({{asset('media/'.$design_type->thumbnail)}}) no-repeat;background-position: center center;background-size: contain;"></div>
                <span class="text-white">
                    <i data-target="#{{$design_type->slug}}Data" class="check-design-option" data-feather="check-circle"></i>
                </span>
            </div>
            <p class="text-capitalize">{{$design_type->title}}</p>
            @endforeach
            <div class="sidemenu extended">
                <div class="heading-wrapper justify-content-between align-items-center">
                    <h5 class="m-0">Choose Colors</h5>
                    <i id="closeMenu" data-feather="x-circle"></i>
                </div>
                <div class="content-actions-wrap justify-content-between">
                    <input type="text" id="searchInput" placeholder="Search">
                    <div class="content-actions-icons-wrap">
                        <i id="searchIcon" data-feather="search"></i>
                        <i id="filterIcon" data-feather="filter"></i>
                        <i id="sortIcon" data-feather="list"></i>
                    </div>
                </div>
                <div class="custom-scroll designs-scroll scroll-width-thin">
                    <div class="filters-wrapper" id="filtersWrap"> 
                        <div class="select-fil-d-main">
                            <select type="button" class="select-filter-input js-example-basic-single" name="value">
                                <option></option>
                            </select>                                        
                        </div>      
                        <div class="select-fil-d-main dropdown">
                            <button type="button" class="select-filter-input dropdown-toggle mb-2" data-toggle="dropdown">
                                Price
                                <span class="material-icons" style="top:0;">
                                arrow_drop_up
                                </span>
                                <span class="material-icons">
                                arrow_drop_down
                                </span>
                                <span class="float-right filter-button-badge price-badge"></span>
                            </button>                                                
                            <div class="dropdown-menu">
                                <h6 class="border-bottom" style="padding-bottom:5px;">Price Range</h6>
                                <div class="pl-2 pr-2">
                                    <div class="value-box price">
                                        <span class="start-value"></span>
                                        <span>-</span>
                                        <span class="end-value"></span>
                                    </div>
                                    <input type="text" class="js-range-slider price-filter" name="price_range"/>
                                </div>
                            </div>                                          
                        </div> 
                        <div class="select-fil-d-main dropdown">
                            <button type="button" class="select-filter-input dropdown-toggle" data-toggle="dropdown">
                                Rating
                                <span class="material-icons" style="top:0;">
                                arrow_drop_up
                                </span>
                                <span class="material-icons">
                                arrow_drop_down
                                </span>
                                <span class="float-right filter-button-badge rating-badge"></span>
                            </button>                                                
                            <div class="dropdown-menu">
                                <h6 class="border-bottom" style="padding-bottom:5px;">Rating Range</h6>
                                <div class="pl-2 pr-2">
                                    <div class="value-box rating">
                                        <span class="start-value"></span>
                                        <span>-</span>
                                        <span class="end-value"></span>
                                    </div>
                                    <input type="text" class="js-range-slider rating-filter" name="price_range"/>
                                </div>
                            </div>                                          
                        </div>                                        
                    </div>
                    <div class="filters-wrapper" id="sortWrap">       
                        <div class="select-fil-d-main">
                            <select type="button" class="select-filter-input js-example-basic-single" id="sortInput">
                                <option value="asc">Name A-Z</option>
                                <option value="desc">Name Z-A</option>
                                <option value="low_to_high">Price low to high</option>
                                <option value="high_to_low">Price high to low</option>
                            </select>                                        
                        </div>                                  
                    </div>
                    @foreach($design_types as $design_type)
                    <div id="{{$design_type->slug}}Data" class="content-container custom-scroll scroll-width-thin">
                        <div class="designs-wrapper container">
                            @if($design_type->can_open == 1)
                            <div class="d-flex align-items-center justify-content-end" style="margin-bottom:10px">
                                <p class="m-0 mr-2">Open Cabinets</p>
                                <input class="tgl tgl-ios" id="cb2" type="checkbox" />
                                <label class="tgl-btn mb-0" for="cb2"></label>
                            </div>
                            @endif
                            <div class="row">
                                @foreach($design_type->designs as $design)
                                <div class="col-sm-4 col-6">
                                    <div class="design-container image-icons-wrap mb-1 {{($design->is_default == 1)?'color-active':''}}">
                                        <div class="w-100 design back-image {{($design->is_default == 1)?'fade-image':''}}" style="background: url('{{asset('media/uploads/'.$design_type->title.'/'.$design->thumbnail)}}')"></div>
                                        <span class="text-white d-flex {{($design->is_default == 1)?'show-buttons':''}}">
                                            <i data-feather="check-circle" class="mr-1 check-color-option {{($design->is_default == 1)?'button-active':''}}" data-design-group-view1='{{($design_group->base_image_view1)?asset("media/uploads/".$design_group->base_image_view1):""}}'
                                            data-design-group-view2='{{($design_group->base_image_view2)?asset("media/uploads/".$design_group->base_image_view2):""}}'
                                            data-design-type='{{$design_type->slug}}'
                                            data-design-view1='{{($design->image_view1)?asset("media/uploads/".$design_type->title."/".$design->image_view1):""}}'
                                            data-design-view2='{{($design->image_view2)?asset("media/uploads/".$design_type->title."/".$design->image_view2):""}}'></i>
                                            <i data-feather="info" onclick="showFeatureModal({{$design->id}}, '{{$design_type->title}}')"></i>
                                        </span>
                                    </div>
                                    <p class="text-capitalize" data-price="{{$design->price}}">{{$design->title}}</p>
                                </div>  
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="download-action-buttons d-flex justify-content-center align-items-center">
        <i data-feather="download" class="mr-2" onclick="downloadCanvasImage()"></i>
        <i data-feather="file-text" onclick="downloadPdf()"></i>
    </div>
</div>
<!-- Feature Modal  -->
<div class="modal fade right inner-sliding-modal" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <div class="d-flex">
                    <span class="material-icons mr-2" style="background: #7bc22a;">
                    color_lens
                    </span>
                    <h5>Product Info</h5>
                </div>
                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons cross">
                    cancel
                    </span>
                </div>
            </div>
            <!--Body-->
            <!-- Spinner/Loader -->
            <svg xmlns:svg="http://www.w3.org/2000/svg" id="loader" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);opacity:0; transition: 0.3s ease opacity;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><linearGradient id="linear-gradient"><stop offset="0%" stop-color="#ffffff" fill-opacity="0"/><stop offset="100%" stop-color="#4d4d4d" fill-opacity="1"/></linearGradient><path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient)" fill-rule="evenodd"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1080ms" repeatCount="indefinite"></animateTransform></g></svg>
            <div class="modal-body pl-4 pb-4 custom-scroll scroll-width-thin" style="display:none;">
                <div class="feature-wrapper">
                    <div class="feature-image-wrapper pb-3">
                        <img class="w-100 border border-dark" src="">
                    </div>
                    <div class="d-flex mb-2 info-wrapper">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            texture
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 12px;text-transform: uppercase;color: #666;line-height: 1.8; margin:0;">
                            Material
                            </h6>
                            <p class="d-block m-0 f-material" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            Wood
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-2 info-wrapper">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            construction
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 12px;text-transform: uppercase;color: #666;line-height: 1.8; margin:0;">
                            Manufacturer
                            </h6>
                            <p class="d-block m-0 f-manufacturer" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            John Doe
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-2 info-wrapper">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            portrait
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 12px;text-transform: uppercase;color: #666;line-height: 1.8; margin:0;">
                            Name
                            </h6>
                            <p class="d-block m-0 f-name" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            Design 1
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-2 info-wrapper">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            attach_money
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 12px;text-transform: uppercase;color: #666;line-height: 1.8; margin:0;">
                            Price
                            </h6>
                            <p class="d-block m-0 f-price" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            $1,000
                            </p>
                        </div>
                    </div>
                    <div class="d-flex info-wrapper">
                        <span class="material-icons" style="font-size: 40px;padding: 0 10px 0 0px;">
                            lock_open
                        </span>
                        <div class="feature-text">
                            <h6 class="d-block" style="font-size: 12px;text-transform: uppercase;color: #666;line-height: 1.8; margin:0;">
                            Id
                            </h6>
                            <p class="d-block m-0 f-id" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
                            66545
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Feature Modal -->