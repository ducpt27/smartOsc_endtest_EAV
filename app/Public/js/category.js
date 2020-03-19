$(document).ready(function() {
    var filter = new Array();
    var current = 1;
    var total = 0;
    var num = 6;

    $.ajax({
        type: 'post',
        url: '?scope=page&action=getProduct',
        data: null,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            appendData(response);
        }
    });

    $('.filter a').click(function(e) {
        e.preventDefault();
        let parent = $(e.target).parent();
        let id = $(e.target).attr('name');
        let isActive = false;

        if ($(e.target).attr('active') == undefined) {
            $(e.target).attr('active', true);
            isActive = true;
        } else {
            $(e.target).removeAttr('active');
            isActive = false;
        }

        if  (isActive) {
            parent.addClass('active');
        } else {
            parent.removeClass('active');
        }
        current = 1;
        setFilter();
        sendFilter();
    });

    function setFilter() {
        filter = new Array();
        $('.filter a').each(function(index, item) {
            let isActive = $(item).attr('active');
            if (isActive) {
                let name = $(item).attr('name');
                let value = $(item).attr('value');
                let fil = {'name': name,'value': value};
                filter.push(fil);
            }
        });
        let fil = {'name': 'id','value': current};
        filter.push(fil);
    }

    $('.pagination').click(function(e) {
        e.preventDefault();
        let switch_page = parseInt($(e.target).attr('data-value'));
        current = switch_page;
        setFilter();
        sendFilter();
    });

    function sendFilter() {
        let form = $('form[name="form-filter"]');
        form.html("");

        filter.forEach(function(item) {
            let name = item['name'];
            let value = item["value"];
            let html = '';

            if (name == 'id' || name == 'num') {
                html = '<input type="hidden" value="'+ value + '" name="' + name + '">';
            } else {
                html = '<input type="hidden" value="'+ value + '" name="' + name + '[]">';
            }
            form.append(html);
        });

        form.submit();
    }

    $('form[name="form-filter"]').validate({
        submitHandler: function(form) {
            $.ajax({
                type: form.method,
                url: form.action,
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    appendData(response);
                }
            });
        }
    });

    function appendPaging() {
        pages = Math.ceil(total/num);

        let elem = $('.pagination');
        elem.html("");

        for (let i = 0; i < pages; i++) {
            let html = '<li class="page-item"><a class="page-link" data-value='+ (i+1) +' href="#">'+ (i+1) +'</a></li>';
            if ((i+1) === current) {
                html = '<li class="page-item active"><a class="page-link" data-value='+ (i+1) +' href="#">'+ (i+1) +'</a></li>';
            }
            elem.append(html);
        }
    }

    function appendData(data) {
        let elem = $('.latest_product_inner');
        let pagination = $('.pagination');
        elem.html("");
        pagination.html("");

        if (data == null) {
            elem.append("<div class='notify col-xs-12'>No products that match the filter</div>");
            return;
        }

        total = data[0]['full_count'];
        num = 6; //TODO get total products show in page
        appendPaging();

        data.forEach(item => {
            let price = (item['price'] && typeof item['price'][0] !== 'undefined') ? item['price'][0] : 0;
            price = formatNumber(price);
            let image = (item['image'] && typeof item['image'][0] !== 'undefined') ? item['image'][0] : '';
            let name = (item['name'] && typeof item['name'][0] !== 'undefined') ? item['name'][0] : '';

            html = '<div class="col-lg-4 col-md-4 col-sm-6">\n'+
                '                        <div class="f_p_item">\n'+
                '                            <div class="f_p_img">\n'+
                '                                <img class="img-fluid" src="app/public/'+ image +'" alt="">\n'+
                '                                <div class="p_icon">\n'+
                '                                    <a href="#"><i class="lnr lnr-heart"></i></a>\n'+
                '                                    <a href="#"><i class="lnr lnr-cart"></i></a>\n'+
                '                                </div>\n'+
                '                            </div>\n'+
                '                            <a href="?scope=page&action=showProductDetails&id='+ item['entity_id'][0] +'"><h4>'+ name +'</h4></a>\n'+
                '                            <h5>$'+ price +'</h5>\n'+
                '                        </div>\n'+
                '                    </div>';
            elem.append(html);
        });
    }
});

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}