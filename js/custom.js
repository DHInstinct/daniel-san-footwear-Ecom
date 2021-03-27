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

    //hide the success/error message until the button is clicked
    $('.added').hide();
    //event listener for adding to cart
    $('#addToCart').click(function () {

        $.ajax(
            {
                url: "js/ajax/addToCart.php",
                data: { product: $(this).data("id") },
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
});
