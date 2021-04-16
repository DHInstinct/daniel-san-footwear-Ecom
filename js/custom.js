// Custom js

$(document).ready(function () {

    // alert("Test");

    $('#search').keyup(function () {

        if ($(this).val() != "") {

            $.ajax({
                type: 'POST',
                url: 'js/ajax/search.php',
                data: { 'query': $(this).val() },
                dataType: 'json',
                success: function (data) {
                    // alert("success");
                    var output = "";
                    var currentCategory = "";
                    // here is where we process the json that is returned and build our search results
                    $.each(data, function (index, element) {
                        if (currentCategory != element.category) {
                            output += "<h2 id='searchtitle'>" + element.category + "</h2>";
                        }
                        output += "<a class='productsearch' href='product.php?id=" + element.id + "'><span class='font-weight-bold'>" + element.name + "</span></a> $" + element.price + "<br />";
                        currentCategory = element.category;
                    });
                    $('#outputsearch').html(output);
                },
                error: function (data) {
                    alert("error bringing back search results");
                }
            });
        }
        else {
            $('#search').html("");
            $('#outputsearch').html("");
        }

    });


    //manufacturing fliter
    $('.manu').click(function () {

        var manu = $(this).html();

        $('.product').each(function () {
            $(this).parent().show();
            if ($(this).children().find('.manufacturer').html() != manu) {
                $(this).parent().hide();
            }
        });
    });

    //manufacturing fliter
    $('.model').click(function () {

        var model = $(this).html();

        $('.product').each(function () {
            $(this).parent().show();
            if ($(this).children().find('.modeltype').html() != model) {
                $(this).parent().hide();
            }
        });
    });


    /* This is basic - uses default settings */

    // $("a#single_image").fancybox();
    // $('.imagepopup').click(function () {
    //     alert('hi').fancybox();
    //     $('.imagepopup').fancybox();
    //   });

    /* Using custom settings */

    //hide the success/error message until the button is clicked
    $('.added').hide();
    //event listener for adding to cart
    $('#addToCart').click(function () {

        $('#success').html("<b>Added To your cart!</b>")

        var option = $('.option').children('option:selected').data('option');
        // alert($('option').children());
        var optionsArray = [];

        // $('.option').each(function (index, value) {
        optionsArray.push({
            // option: $('option'),
            // });
        });

        console.log(JSON.stringify(optionsArray));

        $.ajax(
            {
                url: "js/ajax/addToCart.php",
                data: { product: $(this).data("id"), option: option },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    $('.added').fadeIn();
                    $('.added').children().html("<a href='shopping-cart.php'><strong>Added To Cart<strong><h6>Click me to view shopping cart!</h6></a>").fadeIn();
                    $('.miniCartBody').append("<tr><td class='si-pic'><img class='img-thumbnail miniImg' src=" + data.image + "></td><td class='si-text'><div class='product-selected'><p>Items in cart:" + data.cartQty + " </p><h6></h6></div></td><td class='si-close'></td></tr>");

                },
                error: function (data) {
                    $('.added').fadeIn();
                    $('.added').children().html("<a href='shopping-cart.php'><strong>There was an error adding item to your cart :(<strong><h6>Click me to view shopping cart!</h6></a>");

                }
            }
        );
    });

    //event listener for updating to cart
    $('#updateCart').click(function (e) {
        // console.log($(this).data("id"));
        e.preventDefault();
        //make product array
        var productArray = [];

        //pushing prodID and new quantities into the productArray
        $('.prodIDdata').each(function () {
            productArray.push({
                pID: $(this).data('id'),
                qty: $(this).val()
            });
        });

        //stringifying product array
        var v = JSON.stringify(productArray);

        //Ajax call to updateCart with updated product array
        $.ajax(
            {
                type: 'POST',
                url: 'js/ajax/updateCart.php',
                data: { productArray: v },
                dataType: 'json',
                success: function (data) {
                    $('#updatedCart').html("<a href='shopping-cart.php'><strong><h3>Updated Cart!</h3><strong>Click me!</a>").fadeIn();
                    $.each(data, function (index, d) {
                        $('.added').fadeIn();
                        $(".miniCartBody").append(d.id);
                        $(".miniCartBody").append(d.qty);
                    });
                },
                error: function (data) {
                    $('#updatedCart').html("<a href='shopping-cart.php'><strong><h3>Error Updating Cart :( </h3><strong>Click me!</a>").fadeIn();
                    $('.added').fadeIn();


                }
            }
        );
    });



    //quick view
    $('.quickview').click(function () {

        var name = $(this).data("name");
        var price = $(this).data('price');
        var img = $(this).data('img');
        var id = $(this).data('id');

        $.ajax(
            {
                url: "js/ajax/quickview.php",
                data: { name: name, price: price, img: img, id: id },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    $('#title').html(data.name)
                    $('#price').html(data.price)
                    $('#img').attr("src", data.img)
                    $('#addToCart').attr("data-id", data.id)

                },
                error: function (data) {
                    alert("error");
                }
            }
        );
    });


    $('#AddUser').click(function () {

        var email = $('#email').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var password = $('#pass').val();
        
        $.ajax(
            {
                url: "js/ajax/adduser.php",
                data: { email: email, fname: fname, lname: lname, password: password },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    // $('#title').html(data.name)
                    // $('#price').html(data.price)
                    // $('#img').attr("src", data.img)
                    // $('#addToCart').attr("data-id", data.id)

                },
                error: function (data) {
                    alert("error");
                }
            }
        );
        
    });

    //handing login
    $('#login').click(function () {

        var email = $('#emaillogin').val();
        var password = $('#passlogin').val();
        
        $.ajax(
            {
                url: "js/ajax/processlogin.php",
                data: { email: email, password: password },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    // add confromation that they logged in
                },
                error: function (data) {
                    alert("error");
                }
            }
        );
        
    });

    //adding address
    $('#addAddress').click(function (){
        // address variables
        var street = $('#street').val(); 
        var zip = $('#zip').val(); 
        var town = $('#town').val(); 
        var state = $('#state').val(); 

        //ajax call
        $.ajax({
            url: 'js/ajax/addAddress.php',
            data:{street: street, zip: zip, town: town, state: state},
            method: 'post',
            dataType: 'json',

            success: function (data){
                alert('Success');
            }, 

            error: function (data){
                alert('Error adding address.');
            }
        });
        
    });



    //implementing tiny sort

    //https://stackoverflow.com/questions/8433691/sorting-list-of-elements-in-jquery
    // function getSorted(selector, attrName) {
    //     return $($(selector).toArray().sort(function (a, b) {
    //         var aVal = parseInt(a.getAttribute(attrName)),
    //             bVal = parseInt(b.getAttribute(attrName));
    //         return aVal - bVal;
    //     }));
    // }
    //sorting price asc
    $('.sort-price-asc').click(function () {
        tinysort('div.sort>div', { data: 'price', order: 'asc' });

    });

    //sorting price desc
    $('.sort-price-desc').click(function () {

        tinysort('div.sort>div', { data: 'price', order: 'desc' });
    });

    //sorting name asc
    $('.sort-name-az').click(function () {

        tinysort('div.sort>div', { data: 'name', order: 'asc' });

    });

    //sorting name desc
    $('.sort-name-za').click(function () {

        tinysort('div.sort>div', { data: 'name', order: 'desc' });

    });
});
