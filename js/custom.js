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
                    alert("error quick view");
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
                    $('.registarConfirm').html("<script type='text/javascript'> document.location = 'login.php'; </script>");
                },
                error: function (data) {
                    $('.registarConfirm').html("<div class='text-center'><h3>Unable to registar Please Try again!</h3></div>");

                }
            }
        );

    });

    //handing login
    $('#login').click(function (e) {

        e.preventDefault();

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
                    $('.loginError').html("<script type='text/javascript'> document.location = 'index.php'; </script>");

                },
                error: function (data) {
                    $('.loginError').html("<div class='text-center'><h3>Invalid Username/password. Please Try again!</h3></div>");
                }
            }
        );
    });

    $('#addressSuccess').hide();

    //adding address
    // $('.addAddress').on("submit", function (e) {
    $('.submitForm').on("submit", function (e) {
        // address variables
        e.preventDefault();

        var street = $('#street').val();
        var street2 = $('#street2').val();
        var zip = $('#zip').val();
        var town = $('#town').val();
        var state = $('#state').val();

        //card variables 
        var cardname = $('#cardname').val()
        var cardNum = $('#cardnum').val()
        var mm = $('#mm').val()
        var cvv = $('#cvv').val()


        //ajax call
        $.ajax({
            url: 'js/ajax/addAddress.php',
            data: { street: street, street2: street2, zip: zip, town: town, state: state, cardname: cardname, cardNum: cardNum, mm: mm, cvv: cvv },
            method: 'post',
            dataType: 'json',

            success: function (data) {
                $('#addressSuccess').fadeIn();
                $('#addressAppend').html("Address and Card added.")
            },

            error: function (data) {
                $('#addressSuccess').fadeIn();
                $('#addressAppend').html("Something went wrong! Please check if you have entered correct data in all fields.")

            }
        });

    });

    $('#checkoutbtn').hide();

    //checking address with api ajax call.
    $('#confirmAddress').on("click", function (e) {
        // address variables

        e.preventDefault();
        var zip = $('#zip').val();
        var weight = $('#weight').html();

        $.ajax({
            url: 'js/ajax/shipping.php',
            data: { zip: zip, weight: weight },
            method: 'post',
            dataType: 'json',

            success: function (data) {
                //updating ups shipping cost field
                $('#calculatedTotal').append(data);
                $('#checkoutbtn').show();


                //fixing total price
                total = $('#totalprice').html();
                total = total.replace('$', '');
                shipping = parseFloat(data)
                Total = parseFloat(total);

                final = Total += shipping

                final = final.toFixed(2);

                $('#totalprice').html('$');
                $('#totalprice').append(final);
            },

            error: function (data) {
                $('#addressSuccess').fadeIn();
                $('#addressAppend').html("Something went wrong! Please check your Zip Code.")

            }
        });

    });

    $('.placedOrder').hide();
    $('.errorOrder').hide();
    //placing order 
    $('#checkoutbtn').click(function (e) {

        e.preventDefault();
        //variables for order 
        var shippingAddID = $('#addid').val();
        var billingAddID = $('#addid').val();
        var cardID = $('#carid').val();
        var orderShip = $('#calculatedTotal').html();

        //ignoring dollar sign
        orderShip = orderShip.replace('$', '')

        $.ajax({
            url: 'js/ajax/placeorder.php',
            method: 'post',
            data: { shippingAddID: shippingAddID, billingAddID: billingAddID, cardID: cardID, orderShip: orderShip },
            dataType: 'json',
            success: function (data) {
                $('.placedOrder').fadeIn();
                $('#tracking').append(data.ord_track);
            },
            error: function (data) {
                $('.errorOrder').fadeIn();
            }
        });

    });


    //filling address form and card form on click
    $('.fillCard').click(function () {

        $('#street').val($(this).data('street'));
        $('#addid').val($(this).data('addid'));
        $('#addID').val($(this).data('addid'));
        $('#cardid').val($(this).data('cardid'));
        $('#street2').val($(this).data('street2'));
        $('#zip').val($(this).data('zip'));
        $('#town').val($(this).data('town'));
        $('#state').val($(this).data('state'));
        $('#cardname').val($(this).data('carname'));
        $('#cardnum').val($(this).data('cnum'));
        $('#mm').val($(this).data('month'));
        $('#cvv').val($(this).data('cvv'));
        $('#addid').val($(this).data('addid'));
        $('#carid').val($(this).data('carid'));
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
