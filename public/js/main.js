feather.replace()
// Header & Footer
let openMenu = true;
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
    drawStuff(); 
}
resizeCanvas();
function drawStuff() {
    if(window.innerHeight > window.innerWidth){
        var img = new Image();
        img.onload= drawImageScaled.bind(null, img, ctx);
    
        function drawImageScaled(img, ctx) {
            var hRatio = canvas.width  / img.width;
            var vRatio =  canvas.height / img.height;
            var ratio  = Math.min ( hRatio, vRatio );
            var centerShift_x = ( canvas.width - img.width*ratio ) / 2;
            var centerShift_y = ( canvas.height - img.height*ratio ) / 2;  
            ctx.clearRect(0,0,canvas.width, canvas.height);
            ctx.drawImage(img, 0,0, img.width, img.height,
                                centerShift_x,centerShift_y,img.width*ratio, img.height*ratio);  
        }
        img.src = '../media/base-image.png';
    } else {
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
        var image = new Image();
        image.src = '../media/base-image.png';
        image.onload = function(){
            drawImageProp(ctx, image, 0, 0, canvas.width, canvas.height);
        }
    }
}
// Toggle Button - View Button
$('.cb-value').on('click', function() {
    var mainParent = $(this).parent('.toggle-btn');
    if($(mainParent).find('input.cb-value').is(':checked')) {
        $(mainParent).addClass('active');
    } else {
        $(mainParent).removeClass('active');
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
    $(this).toggleClass('button-active');
    $('#searchInput').toggleClass('show-input');
    $('#searchInput').val('');
});

// Filter Icon
$('#filterIcon').on('click', function(){
    $('.content-actions-icons-wrap svg').not(this).removeClass('button-active');
    $('#searchInput').removeClass('show-input');
    $('#sortWrap').removeClass('open');
    $('.design-options-wrapper .sidemenu.extended .content-container').removeClass('add-sort-height');
    $('.design-options-wrapper .sidemenu.extended .content-container').toggleClass('add-filter-height');
    $(this).toggleClass('button-active');
    $('#filtersWrap').toggleClass('open');
});

// Sort Icon
$('#sortIcon').on('click', function(){
    $('.content-actions-icons-wrap svg').not(this).removeClass('button-active');
    $('#searchInput').removeClass('show-input');
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


//Price Formatter
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
});

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
    placeholder: 'Select Color',
});

// Filters
//Price Filter
$(".price-filter").ionRangeSlider({
    type: "double",
    min: 0,
    max: 1000,
    from: 0,
    to: 1000,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
    },
    onChange: function (data) {
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
    },
    onFinish: function(data){  

    }
});

//Rating Filter
$(".rating-filter").ionRangeSlider({
    type: "double",
    min: 0,
    max: 5,
    from: 0,
    to: 1000,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .rating .start-value").html(data.from);
        $(".select-fil-d-main .dropdown-menu .rating .end-value").html(data.to);
        $(".rating-badge").html(`${data.from} - ${data.to}`);
    },
    onChange: function (data) {
        $(".select-fil-d-main .dropdown-menu .rating .start-value").html(data.from);
        $(".select-fil-d-main .dropdown-menu .rating .end-value").html(data.to);
        $(".rating-badge").html(`${data.from} - ${data.to}`);
    },
    onFinish: function(data){  

    }
});

function showFeatureModal(){
    $('#featureModal').modal('show');
}