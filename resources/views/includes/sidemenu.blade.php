<div class="sidemenu custom-scroll scroll-width-thin" id="sideMenu">
    <div class="toggle-btn">
        <input type="checkbox" class="cb-value"/>
        <span class="round-btn"></span>
    </div>
    <div class="design-options-wrapper">
        <div class="design-icons-wrap image-icons-wrap">
            <div class="design-icons back-image" id="cabinetIcon"></div>
            <span class="text-white">
                <i data-target="#cabinetData" class="check-design-option" data-feather="check-circle"></i>
            </span>
        </div>
        <p>Cabinet</p>
        <div class="design-icons-wrap image-icons-wrap">
            <div class="design-icons back-image" id="backsplashIcon"></div>
            <span class="text-white">
                <i data-target="#backsplashData" class="check-design-option" data-feather="check-circle"></i>
            </span>
        </div>
        <p>Backsplash</p>
        <div class="design-icons-wrap image-icons-wrap">
            <div class="design-icons back-image" id="countertopIcon"></div>
            <span class="text-white">
                <i data-target="#countertopData" class="check-design-option" data-feather="check-circle"></i>
            </span>
        </div>
        <p>Countertop</p>
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
                        <select type="button" class="select-filter-input js-example-basic-single" name="value">4
                            <option></option>
                            <option value="red">Red</option>
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
                        <select type="button" class="select-filter-input js-example-basic-single">
                            <option value="a_Z">Name A-Z</option>
                            <option value="z_a">Name Z-A</option>
                            <option value="low_to_high">Price low to high</option>
                            <option value="high_to_low">Price high to low</option>
                        </select>                                        
                    </div>                                  
                </div>
                <div id="cabinetData" class="content-container custom-scroll scroll-width-thin">
                    <div class="designs-wrapper container">
                        <div class="d-flex align-items-center justify-content-end" style="margin-bottom:10px;">
                            <p class="m-0 mr-2">Open Cabinets</p>
                            <input class="tgl tgl-ios" id="cb2" type="checkbox" />
                            <label class="tgl-btn mb-0" for="cb2"></label>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design back-image" style="background: url({{asset('media/sdgf-fabuwood-allure_1.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 1</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/sdge-fabuwood-allure_1.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 2</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/sdfc-fabuwood-allure_1.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 3</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/sdgf-fabuwood-allure_1.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 4</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/sdge-fabuwood-allure_1.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 5</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/sdfc-fabuwood-allure_1.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 6</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="backsplashData" class="content-container">
                    <div class="designs-wrapper container">
                        <div class="row">
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design back-image" style="background: url({{asset('media/backsplash.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 1</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/backsplash.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 2</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/backsplash.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 3</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/backsplash.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 4</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/backsplash.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 5</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/backsplash.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 6</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="countertopData" class="content-container">
                    <div class="designs-wrapper container">
                        <div class="row">
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design back-image" style="background: url({{asset('media/countertop.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 1</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/countertop.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 2</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/countertop.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 3</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/countertop.jpg')}});"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 4</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/countertop.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 5</p>
                            </div>
                            <div class="col-sm-4 col-6">
                                <div class="design-container image-icons-wrap mb-1">
                                    <div class="w-100 design mb-1 back-image" style="background: url({{asset('media/countertop.jpg')}})"></div>
                                    <span class="text-white d-flex">
                                        <i data-feather="check-circle" class="mr-1 check-color-option"></i>
                                        <i data-feather="info" onclick="showFeatureModal()"></i>
                                    </span>
                                </div>
                                <p>Design 6</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <h5>Color Option</h5>
                </div>
                <div data-toggle="collapse" data-target="#floor-tab-1" class="close-tab" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons cross">
                    cancel
                    </span>
                </div>
            </div>
            <!--Body-->
            <div class="modal-body pl-4 pb-4 custom-scroll scroll-width-thin">
                <div class="feature-wrapper">
                    <div class="feature-image-wrapper pb-3">
                        <img class="w-100 border border-dark" src="{{asset('media/sdfc-fabuwood-allure_1.jpg')}}">
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
                            <p class="d-block m-0 f-id" style="font-size: 16px;line-height: 0.6; text-transform:capitalize;">
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