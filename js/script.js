var name_pattern = /^[A-Za-z]{3,20}$/;

var address_pattern = /^[a-zA-Z0-9]/;

var city_pattern = /^[a-zA-Z0-9\s]/;

var email_pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

var phone_pattern = /^[0-9]{9}$/;

var first_name;
var last_name;
var address_1;
var city;
var email;
var phone;

var fn_bool;
var ln_bool;
var ad_bool;
var c_bool;
var e_bool;
var p_bool;

function send_request(url) {
    "use strict";
    var obj, result;
    obj = $.ajax({
        url: url,
        async: false
    });
    result = $.parseJSON(obj.responseText);
    return result;
}

function get_phone_code() {
    var url, result, iso, pc;

    iso = $("#billing_country").val();

    url = "controller.php?cmd=1&iso3=" + iso;
    result = send_request(url);
    pc = result.phonecode;
    $("#billing_phone_code").val('+' + pc);
    //alert(result.phonecode);
}

function disable() {
    $('#place_order').hide();
}

function enable() {
    $("#place_order").show();
}

function validate_firstname() {

    first_name = $("#billing_first_name").val();

    fn_bool = name_pattern.test(first_name);

    if (first_name.length < 3) {
        $("#billing_first_name").css("border-color", "crimson");
        disable();
    }

    if (fn_bool === false) {
        $("#billing_first_name").css("border-color", "crimson");
        disable();
    }

    if (fn_bool === true && first_name.length >= 3) {
        $("#billing_first_name").css("border-color", "#40F549");
        enable();
    }
}

function validate_lastname() {
    last_name = $("#billing_last_name").val();

    ln_bool = name_pattern.test(last_name);

    if (last_name.length < 3) {
        $("#billing_last_name").css("border-color", "crimson");
        disable();
    }

    if (ln_bool === false) {
        $("#billing_last_name").css("border-color", "crimson");
        disable()
    }

    if (ln_bool === true && last_name.length >= 3) {
        $("#billing_last_name").css("border-color", "#40F549");
        enable();
    }
}

function validate_address() {
    address_1 = $("#billing_address_1").val();

    ad_bool = address_pattern.test(address_1);

    if (address_1.length < 3) {
        $("#billing_address_1").css("border-color", "crimson");
        disable();
    }

    if (ad_bool === false) {
        $("#billing_address_1").css("border-color", "crimson");
        disable();
    }

    if (ad_bool === true && address_1.length >= 3) {
        $("#billing_address_1").css("border-color", "#40F549");
        enable();
    }
}

function validate_city() {
    city = $("#billing_city").val();

    c_bool = city_pattern.test(city);

    if (city.length < 3) {
        $("#billing_city").css("border-color", "crimson");
        disable();
    }

    if (c_bool === false) {
        $("#billing_city").css("border-color", "crimson");
        disable();
    }

    if (c_bool === true && city.length >= 3) {
        $("#billing_city").css("border-color", "#40F549");
        enable();
    }
}

function validate_email() {
    email = $("#billing_email").val();

    e_bool = email_pattern.test(email);

    if (email.length < 3) {
        $("#billing_email").css("border-color", "crimson");
        disable();
    }

    if (e_bool === false) {
        $("#billing_email").css("border-color", "crimson");
        disable();
    }

    if (e_bool === true && city.length >= 3) {
        $("#billing_email").css("border-color", "#40F549");
        enable();
    }
}

function validate_phone() {
    phone = $("#billing_phone").val();

    p_bool = phone_pattern.test(phone);

    if (phone.length < 9 || phone.length > 9) {
        $("#billing_phone").css("border-color", "crimson");
        disable();
    }

    if (p_bool === true && phone.length === 9) {
        $("#billing_phone").css("border-color", "#40F549");
        enable();
    }
}



