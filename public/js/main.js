feather.replace()

// Global Variables
var openMenu = true, filterMinPrice, filterMaxPrice,
searchApplied = false, 
filterApplied = false, 
items, fromPrice = 0, 
toPrice = 1200, 
itemsShown = [], view = 'kitchen-view'
canvas = document.getElementById('canvas'),
ctx = canvas.getContext('2d'), 
allContent = $('.content-container').find('.design-container').next(),
filterContent = [];

//Price Formatter
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
});

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
    if(event.target.screen.orientation.angle == 0){
        toastr.info("For better experience switch to landscape mode");
    }
    else if (event.target.screen.orientation.angle == 90){
        toastr.clear();
    }
};

// resize the canvas to fill browser window dynamically
window.addEventListener('resize', resizeCanvas, false);
function resizeCanvas() {
    if(window.innerWidth > 991){
        canvas.width = $('.main-wrapper').innerWidth()-140;
    } else {
        canvas.width = $('.main-wrapper').innerWidth();
    }
    canvas.height = $('.main-wrapper').innerHeight();
    if($('.toggle-btn').find('input.cb-value').is(':checked')) {
        $('.toggle-btn').addClass('active');
        drawStuff(sourcesView2);
    } else {
        $('.toggle-btn').removeClass('active');
        drawStuff(sourcesView1);
    }
}
resizeCanvas();

function drawStuff(sources) {
    loadImages(sources, function(images) {
        $.each(images, function(){
            if(window.innerHeight > window.innerWidth){
                drawImageScaled(this, ctx);
            }
            else{
                drawImageProp(ctx, this, 0, 0, canvas.width, canvas.height);
            }
            $('#mainLoader').hide();
        });
    });
}

function loadImages(sources, callback) {
    $('#mainLoader').show();
    var images = {};
    var loadedImages = 0;
    var numImages = 0;
    // get num of sources
    for(var src in sources) {
        numImages++;
    }
    for(var src in sources) {
        images[src] = new Image();
        images[src].onload = function() {
            if(++loadedImages >= numImages) {
                callback(images);
            }
        };
        images[src].src = sources[src];
    }
}

function drawImageScaled(img, ctx) {
    var hRatio = canvas.width  / img.width;
    var vRatio =  canvas.height / img.height;
    var ratio  = Math.min ( hRatio, vRatio );
    var centerShift_x = ( canvas.width - img.width*ratio ) / 2;
    var centerShift_y = ( canvas.height - img.height*ratio ) / 2;  
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

// Toggle Button - View Button
$('.cb-value').on('click', function() {
    var mainParent = $(this).parent('.toggle-btn');
    if($(mainParent).find('input.cb-value').is(':checked')) {
        $(mainParent).addClass('active');
        drawStuff(sourcesView2);
        view = 'top-view'
    } else {
        $(mainParent).removeClass('active');
        drawStuff(sourcesView1);
        view = 'kitchen-view'
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
    const parent = $(this).parents('.designs-wrapper'),
    element = parent.find('.check-color-option.button-active'),
    designTypeValue = element.attr('data-design-type'),
    designView1Value = element.attr('data-design-view1'),
    designView2Value = element.attr('data-design-view2'), 
    openViewImage = element.attr('data-open-view'),
    openView2Image = element.attr('data-open-view2');
    
    if($(this).is(':checked')) {
        $(this).prev().text('Close Cabinets');
        if(openViewImage != ""){
            sourcesView1[designTypeValue] = openViewImage;
        }
        if(openView2Image != ""){
            sourcesView2[designTypeValue] = openView2Image;
        }
    } else {
        $(this).prev().text('Open Cabinets');
        sourcesView1[designTypeValue] = designView1Value;
        sourcesView2[designTypeValue] = designView2Value;
    }

    if($('.toggle-btn').find('input.cb-value').is(':checked')) {
        drawStuff(sourcesView2);
    } else {
        drawStuff(sourcesView1);
    }
});

// Color Design Click
function selectColorOption(activeTab){
    $(activeTab).find('.check-color-option').on('click', function(){
        const designGroupView1Value = $(this).attr('data-design-group-view1'),
        designGroupView2Value = $(this).attr('data-design-group-view2'),
        designTypeValue = $(this).attr('data-design-type'),
        designView1Value = $(this).attr('data-design-view1'), 
        designView2Value = $(this).attr('data-design-view2'),
        openViewImage = $(this).attr('data-open-view'),
        openView2Image = $(this).attr('data-open-view2');
        changeLayers(designGroupView1Value, designGroupView2Value, designTypeValue, designView1Value, designView2Value, openViewImage, openView2Image);

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
    $("#featureModal .modal-body").hide();
    $("#loader").addClass('show-loader');
    $.get("/api/get-design-info/"+designId, function( data ) {
        $('.feature-image-wrapper img').attr('src', `/media/uploads/${designType}/${data.thumbnail}`)
        $('.f-material').text(data.material);
        $('.f-manufacturer').text(data.manufacturer);
        $('.f-name').text(data.title);
        $('.f-price').text(formatter.format(data.price));
        $('.f-id').text(data.product_id);
        $("#loader").removeClass('show-loader');
        $("#featureModal .modal-body").fadeIn();
    });
}

// Filters Functionality
function showFilteredData(){
    let values = filterData();
    $(allContent).parent().hide();
    $.each(values,function(){
        $(this).parent().show();
    })
}

function filterData(){
    let searchArray =[], filteredArray = [], textValue;
    var commonValues = allContent;
    let search = document.getElementById('searchInput').value.toUpperCase();
    if(search != ''){
        $.each(allContent, function(){
            textValue = $(this).text();
            if (textValue.toUpperCase().indexOf(search) > -1) {
                searchArray.push(this);
            }
        });
        commonValues = _.intersection(allContent, searchArray);
        if(commonValues.length==0){
            return commonValues;
        }
    }
    $.each(allContent, function(){
        if (Number(this.getAttribute('data-price')) >= filterMinPrice && Number(this.getAttribute('data-price')) <= filterMaxPrice) {
            filteredArray.push(this);
        } 
    });
    commonValues = _.intersection(commonValues,filteredArray);
    return commonValues;
}

//Price Filter
$('.price-filter').ionRangeSlider({
    type: "double",
    min: minPrice,
    max: maxPrice,
    from: minPrice,
    to: maxPrice,
    grid: false,
    skin: "round",
    hide_min_max: true,    
    hide_from_to: true,
    onStart: function(data){
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
        
        // Call filter funtion
        filterMinPrice = data.from;
        filterMaxPrice = data.to;
        showFilteredData();
    },
    onChange: function (data) {
        fromPrice = data.from;
        toPrice = data.to;
        $(".select-fil-d-main .dropdown-menu .price .start-value").html(formatter.format(data.from));
        $(".select-fil-d-main .dropdown-menu .price .end-value").html(formatter.format(data.to));
        $(".price-badge").html(`${formatter.format(data.from)} - ${formatter.format(data.to)}`);
        
        // Call filter funtion
        filterMinPrice = data.from;
        filterMaxPrice = data.to;
        showFilteredData();
    }
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

// Call sort function
$.each($('.content-container'), function(){
    sort(`#${$(this).attr('id')}`);
});

// Layers Click Functionality
function changeLayers(...values){
    if(values[0] != ""){
        sourcesView1.base_image_view1 = values[0];
    }
    if(values[1] != ""){
        sourcesView2.base_image_view2 = values[1];
    }
    if(values[3] != ""){
        if($('#cb2').is(':checked')){
            if(values[5] != ""){
                sourcesView1[values[2]] = values[5];
            }
            else{
                sourcesView1[values[2]] = values[3];
            }
        }
        else{
            sourcesView1[values[2]] = values[3];
        }
    }
    if(values[4] != ""){
        if($('#cb2').is(':checked')){
            if(values[6] != ""){
                sourcesView2[values[2]] = values[6];
            }
            else{
                sourcesView2[values[2]] = values[4];
            }
        }
        else{
            sourcesView2[values[2]] = values[4];
        }
    }
    
    if($('.toggle-btn').find('input.cb-value').is(':checked')) {
        drawStuff(sourcesView2);
    } else {
        drawStuff(sourcesView1);
    }
}

function downloadCanvasImage(){
    var link = document.createElement('a');
    link.download = `design-${view}.png`;
    link.href = canvas.toDataURL()
    link.click();
}

function downloadPdf(){
    var canvasImgData = canvas.toDataURL("image/jpeg", 1.0),
    headerCanvas, headerCtx,
    doc = new jsPDF(),
    selections = $('.design-container.color-active').find('.design'),
    selectionValues = [], designCanvas, designCtx,i=-40;
    function imageSizing(canvasImg){
        var imgProps = doc.getImageProperties(canvasImg), 
        pdfWidth = doc.internal.pageSize.getWidth(),
        pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        return {pdfWidth : pdfWidth,pdfHeight: pdfHeight};
    }
    header();
    doc.addImage(canvasImgData, "JPEG", 10, 40, imageSizing(canvasImgData).pdfWidth - 20, imageSizing(canvasImgData).pdfHeight -20);
    doc.setFontSize(12);
    doc.text("Cabinet", 10, imageSizing(canvasImgData).pdfHeight+30);
    doc.text("Backsplash", 50, imageSizing(canvasImgData).pdfHeight+30);
    doc.text("Countertop", 90, imageSizing(canvasImgData).pdfHeight+30);
    $.each(selections, function(){
        var bg = $(this).css('background-image');
        bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
        selectionValues.push(bg); 
    });  

    function header(){ 
        headerCanvas = document.createElement('canvas');
        headerCtx = headerCanvas.getContext('2d');
        headerCanvas.width = 1538;
        headerCanvas.height = 190;
        var headerImage = new Image();
        headerImage.src = '../media/biorev_header.png';
        headerImage.onload = function(){
            headerCtx.drawImage(headerImage, 0,0,1538,190);
            var headerImageData = headerCanvas.toDataURL();
            doc.addImage(headerImageData, "PNG", 10, 10,imageSizing(headerImageData).pdfWidth -20,imageSizing(headerImageData).pdfHeight -2.5);
        }
    };

    loadImages(selectionValues, function(images) {
        $.each(images, function(){
            designCanvas = document.createElement('canvas');
            designCanvas.width = 79;
            designCanvas.height = 100;
            designCtx = designCanvas.getContext('2d');
            designCtx.drawImage(this, 0,0,79,100);
            i=i+40;
            doc.addImage(designCanvas.toDataURL("image/jpeg"), "JPEG", 10+i, imageSizing(canvasImgData).pdfHeight + 32, 30, 40);
        });
        doc.save(`design-${view}.pdf`);
    });
}

$(".download-action-wrap").on('mouseover', function(){
    $('.download-action-buttons').addClass('show-action-buttons');
});

$(".download-action-container").on('mouseleave', function(){
    $('.download-action-buttons').removeClass('show-action-buttons');
});