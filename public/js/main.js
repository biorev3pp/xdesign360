feather.replace()
// Global Variables
var openMenu = true, searchApplied = false, filterApplied = false, items, fromPrice = 0, toPrice = 1200, itemsShown = [];

// Header & Footer
function openNav() {
    openMenu =! openMenu;
    if(openMenu){
        $("#nav-icon").addClass('open');
        $("#sideMenu").addClass('sidemenu-open');
    }
    else{
        $("#nav-icon").removeClass('open');
        $("#sideMenu").removeClass('sidemenu-open');
    }
}
openNav();

if(window.innerHeight > window.innerWidth){
    toastr.info("For better experience switch to landscape mode");
}
// Orientation Change
window.onorientationchange = function(event) { 
    console.log("the orientation of the device is now " + event.target.screen.orientation.angle);
    if(event.target.screen.orientation.angle == 0){
        toastr.info("For better experience switch to landscape mode");
    }
    else if (event.target.screen.orientation.angle == 90){
        toastr.clear();
    }
};

// Canvas
var canvas = document.getElementById('canvas'),
ctx = canvas.getContext('2d');

// resize the canvas to fill browser window dynamically
window.addEventListener('resize', resizeCanvas, false);
function resizeCanvas() {
    if(window.innerWidth > 991){
        canvas.width = $('.main-wrapper').innerWidth() -140;
    } else {
        canvas.width = $('.main-wrapper').innerWidth();
    }
    canvas.height = $('.main-wrapper').innerHeight();
    drawStuff('../media/base_image1.jpg'); 
}
resizeCanvas();

function drawImageScaled(img, ctx) {
    var hRatio = canvas.width  / img.width;
    var vRatio =  canvas.height / img.height;
    var ratio  = Math.min ( hRatio, vRatio );
    var centerShift_x = ( canvas.width - img.width*ratio ) / 2;
    var centerShift_y = ( canvas.height - img.height*ratio ) / 2;  
    ctx.clearRect(0,0,canvas.width, canvas.height);
    ctx.drawImage(img, 0,0, img.width, img.height,centerShift_x,centerShift_y,img.width*ratio, img.height*ratio);  
}

function drawImageProp(ctx, img, x, y, w, h, offsetX, offsetY) {
    if (arguments.length === 2) {
        x = y = 0;
        w = ctx.canvas.width;
        h = ctx.canvas.height;
    }

    // default offset is center
    offsetX = typeof offsetX === "number" ? offsetX : 0.5;
    offsetY = typeof offsetY === "number" ? offsetY : 0.5;

    // keep bounds [0.0, 1.0]
    if (offsetX < 0) offsetX = 0;
    if (offsetY < 0) offsetY = 0;
    if (offsetX > 1) offsetX = 1;
    if (offsetY > 1) offsetY = 1;

    var iw = img.width,
        ih = img.height,
        r = Math.min(w / iw, h / ih),
        nw = iw * r,   // new prop. width
        nh = ih * r,   // new prop. height
        cx, cy, cw, ch, ar = 1;

    // decide which gap to fill    
    if (nw < w) ar = w / nw;                             
    if (Math.abs(ar - 1) < 1e-14 && nh < h) ar = h / nh;  // updated
    nw *= ar;
    nh *= ar;

    // calc source rectangle
    cw = iw / (nw / w);
    ch = ih / (nh / h);

    cx = (iw - cw) * offsetX;
    cy = (ih - ch) * offsetY;

    // make sure source rectangle is valid
    if (cx < 0) cx = 0;
    if (cy < 0) cy = 0;
    if (cw > iw) cw = iw;
    if (ch > ih) ch = ih;

    // fill image in dest. rectangle
    ctx.drawImage(img, cx, cy, cw, ch,  x, y, w, h);
}

function drawStuff(imageSource) {
    var img = new Image();
    img.src = imageSource;
    img.onload = function(){
        if(window.innerHeight > window.innerWidth){
            drawImageScaled(img, ctx);
        }
        else{
            drawImageProp(ctx, img, 0, 0, canvas.width, canvas.height);
        }
    }
}

// Toggle Button - View Button
$('.cb-value').on('click', function() {
    var mainParent = $(this).parent('.toggle-btn');
    if($(mainParent).find('input.cb-value').is(':checked')) {
        $(mainParent).addClass('active');
        drawStuff('../media/base_image2.jpg');
    } else {
        $(mainParent).removeClass('active');
        drawStuff('../media/base_image1.jpg');
    }
});

// Image Hover Effect
$(".image-icons-wrap").on('mouseenter', function(){
    $(this).find('span').addClass('show-buttons');
    $(this).find('.back-image').addClass('fade-image');
});

$(".image-icons-wrap").not(".image-icons-wrap span").on('mouseleave', function(){
    if(!$(this).hasClass('design-active') && !$(this).hasClass('color-active')){
        $(this).find('span').removeClass('show-buttons');
        $(this).find('.back-image').removeClass('fade-image');
    }
});

//Price Formatter
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
});

// Choose Section Click
$('.design-icons-wrap').find('.check-design-option').on('click', function(){
    $('.design-icons-wrap').find('.check-design-option').removeClass('button-active');
    $('.design-icons-wrap').find('span').removeClass('show-buttons');
    $('.design-icons-wrap').find('.back-image').removeClass('fade-image');
    $('.design-icons-wrap').removeClass('design-active');
    $(this).addClass('button-active');
    $(this).parent().addClass('show-buttons');
    $(this).parent().prev().addClass('fade-image');
    $(this).parent().parent().addClass('design-active');
    $('.extended').addClass('open');
    $('.extended').addClass('custom-border border-left');
    var target = $(this).attr('data-target');
    $('.content-container').hide();
    $(target).fadeIn();
    selectColorOption(target);
});

// Extended Sidemenu Close
$('.extended .heading-wrapper #closeMenu').on('click', function(){
    $('.extended').removeClass('open');
    $('.content-container').hide();
    $('.design-icons-wrap').find('.check-design-option').removeClass('button-active')
    $('.design-icons-wrap').find('span').removeClass('show-buttons');
    $('.design-icons-wrap').find('.back-image').removeClass('fade-image');
    $('.design-icons-wrap').removeClass('design-active');
});

// Search Icon
$('#searchIcon').on('click', function(){
    $('.content-actions-icons-wrap svg').not(this).removeClass('button-active');
    $('#filtersWrap').removeClass('open');
    $('#sortWrap').removeClass('open');
    $('.design-options-wrapper .sidemenu.extended .content-container').removeClass('add-sort-height');
    $('.design-options-wrapper .sidemenu.extended .content-container').removeClass('add-filter-height');
    if($('#searchInput').val() == ""){
        $(this).toggleClass('button-active');
        $('#searchInput').toggleClass('show-input');
    }
});

// Filter Icon
$('#filterIcon').on('click', function(){
    if($('#searchInput').val() == ""){
        $('.content-actions-icons-wrap svg').not(this).removeClass('button-active');
        $('#searchInput').removeClass('show-input');
    }
    else{
        $('.content-actions-icons-wrap svg').not(this).not('.content-actions-icons-wrap svg:first-child').removeClass('button-active');
    }
    $('#sortWrap').removeClass('open');
    $('.design-options-wrapper .sidemenu.extended .content-container').removeClass('add-sort-height');
    $('.design-options-wrapper .sidemenu.extended .content-container').toggleClass('add-filter-height');
    $(this).toggleClass('button-active');
    $('#filtersWrap').toggleClass('open');
});

// Sort Icon
$('#sortIcon').on('click', function(){
    if($('#searchInput').val() == ""){
        $('.content-actions-icons-wrap svg').not(this).removeClass('button-active');
        $('#searchInput').removeClass('show-input');
    }
    else{
        $('.content-actions-icons-wrap svg').not(this).not('.content-actions-icons-wrap svg:first-child').removeClass('button-active');
    }
    $('#filtersWrap').removeClass('open');
    $('.design-options-wrapper .sidemenu.extended .content-container').removeClass('add-filter-height');
    $('.design-options-wrapper .sidemenu.extended .content-container').toggleClass('add-sort-height');
    $(this).toggleClass('button-active');
    $('#sortWrap').toggleClass('open');
});

// Toggle Button - Cabinet
$('.tgl').on('click', function() {
    if($(this).is(':checked')) {
        $(this).prev().text('Close Cabinets');
    } else {
        $(this).prev().text('Open Cabinets');
    }
});

// Color Design Click
function selectColorOption(activeTab){
    $(activeTab).find('.check-color-option').on('click', function(){
        $(activeTab).find('.design-container').find('.check-color-option').removeClass('button-active');
        $(activeTab).find('.design-container').find('span').removeClass('show-buttons');
        $(activeTab).find('.design-container').find('.back-image').removeClass('fade-image');
        $(activeTab).find('.design-container').removeClass('color-active');
        $(this).addClass('button-active');
        $(this).parent().addClass('show-buttons');
        $(this).parent().prev().addClass('fade-image');
        $(this).parent().parent().addClass('color-active');
    });
}

//Bootstrap dropdown
$(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
});
$('.filters-wrapper .dropdown').on('show.bs.dropdown', function () {
    $(this).find('.select-filter-input').addClass('filter-button-active');
});
$('.filters-wrapper .dropdown').on('hide.bs.dropdown', function () {
    $(this).find('.select-filter-input').removeClass('filter-button-active');
});

// Search Select Select2
$('.js-example-basic-single').select2({
    placeholder: 'Select Design',
});

// Info Modal
function showFeatureModal(designId, designType){ 
    $('#featureModal').modal('show');
    $("#loader").addClass('show-loader');
    $.get("/api/get-design-info/"+designId, function( data ) {
        $('.feature-image-wrapper img').attr('src', `/media/${designType}/${data.thumbnail}`)
        $('.f-material').text(data.material);
        $('.f-manufacturer').text(data.manufacturer);
        $('.f-name').text(data.title);
        $('.f-price').text(formatter.format(data.price));
        $('.f-id').text(data.product_id);
        $("#loader").removeClass('show-loader');
        $("#featureModal .modal-body").fadeIn();
    });
}

// Search Function
function search() {
    $('#searchInput').on('input', function(){
        var input, textValue;
        input = document.getElementById('searchInput').value.toUpperCase();
        if(!filterApplied){
            itemsShown = [];
            if(input != ''){
                searchApplied = true;
                items = $('.content-container').find('.design-container').next();
                $.each(items, function(){
                    textValue = $(this).text();
                    var parent = $(this).parent();
                    if (textValue.toUpperCase().indexOf(input) > -1) {
                        parent.show();
                        itemsShown.push(this);
                    } else {
                        parent.hide();
                    }
                });
            }
            else{
                searchApplied = false;
                filter(fromPrice, toPrice);
            }
        }
        else{
            if(input != ''){
                searchApplied = true;
                items = itemsShown;
                $.each(items, function(){
                    textValue = $(this).text();
                    var parent = $(this).parent();
                    if (textValue.toUpperCase().indexOf(input) > -1) {
                        parent.show();
                    } else {
                        parent.hide();
                    }
                });
            }
            else{
                searchApplied = false;
                filter(fromPrice, toPrice);
            }
        }
    });
}

// Filter function
function filter(min, max){
    if(!searchApplied){
        items = $('.content-container').find('.design-container').next();
        itemsShown = [];
        $.each(items, function(){
            var parent = $(this).parent();
            if (Number(this.getAttribute('data-price')) >= min && Number(this.getAttribute('data-price')) <= max) {
                parent.show();
                itemsShown.push(this);
            } else {
                parent.hide();
            }
        });
    }
    else{
        items = itemsShown;
        $.each(items, function(){
            var parent = $(this).parent();
            if (Number(this.getAttribute('data-price')) >= min && Number(this.getAttribute('data-price')) <= max) {
                parent.show();
            } else {
                parent.hide();
            }
        });
    }   
}

//Price Filter
$('.price-filter').ionRangeSlider({
    type: "double",
    min: 0,
    max: 1200,
    from: 0,
    to: 1200,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
        filter(data.from, data.to);
    },
    onChange: function (data) {
        fromPrice = data.from;
        toPrice = data.to;
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
        filter(data.from, data.to);
        filterApplied = true;
    },
});

//Rating Filter
$(".rating-filter").ionRangeSlider({
    type: "double",
    min: 0,
    max: 5,
    from: 0,
    to: 5,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .rating .start-value").html(data.from);
        $(".select-fil-d-main .dropdown-menu .rating .end-value").html(data.to);
        $(".rating-badge").html(`${data.from} - ${data.to}`);
    },
    onChange: function (data){
        $(".select-fil-d-main .dropdown-menu .rating .start-value").html(data.from);
        $(".select-fil-d-main .dropdown-menu .rating .end-value").html(data.to);
        $(".rating-badge").html(`${data.from} - ${data.to}`);
    },
});

// Sort Function
function sort(activeTab) {
    $('#sortInput').on('change', function(){
        var i, switching = true, items, shouldSwitch, sortType = $(this).val();
        /* Make a loop that will continue until no switching has been done: */
        while (switching) {
            // start by saying: no switching is done:
            switching = false;
            items = $(activeTab).find('.design-container').next();
            for(i = 0; i < (items.length - 1); i++){
                shouldSwitch = false;
                if (sortType == "asc") {
                    if (items[i].innerHTML.toLowerCase() > items[i+1].innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } 
                else if (sortType == "desc") {
                    if (items[i].innerHTML.toLowerCase() < items[i+1].innerHTML.toLowerCase()) {
                        shouldSwitch= true;
                        break;
                    }
                }
                else if (sortType == "low_to_high"){
                    console.log(Number(items[i].getAttribute('data-price')));
                    if (Number(items[i].getAttribute('data-price')) > Number(items[i+1].getAttribute('data-price'))) {
                        shouldSwitch = true;
                        break;
                    }
                }
                else if (sortType == "high_to_low"){
                    if (Number(items[i].getAttribute('data-price')) < Number(items[i+1].getAttribute('data-price'))) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switchand mark the switch as done: */
                items[i].parentNode.parentNode.insertBefore(items[i+1].parentNode, items[i].parentNode);
                switching = true;
            }
        }
    });
}

// Call search function
search();

// call sort function
$.each($('.content-container'), function(){
    sort(`#${$(this).attr('id')}`);
});
