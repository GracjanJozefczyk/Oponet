import '../../styles/store.css';
import $ from "jquery";

var $width = $("#srcWidth");
var $height = $("#srcHeight");
var $rim = $("#srcRim");
var $brand = $("#srcBrand");
var $season = $("#srcSeason");
var placeholder = "<option>Choose</option>";

$("#scrollUp").click(function (event) {
    event.preventDefault();
    window.scrollTo(0,0);
});

$width.change(function () {
    $height.empty().prop("disabled", true).prepend(placeholder);
    $rim.empty().prop("disabled", true).prepend(placeholder);
    $.ajax({
        url: '/api/getheights/' + $(this).val(),
        method: 'POST'
    }).done(function (data) {
        data.forEach(height => {
            $height.append(`<option value="${height['id']}">${height['height']}</option>`).prop("disabled", false);
        });
    });
});

$height.change(function () {
    $rim.empty().prop("disabled", true).prepend(placeholder);
    $.ajax({
        url: '/api/getrims/' + $width.val() + '/' + $(this).val(),
        method: 'POST'
    }).done(function (data) {
        data.forEach(rim => {
            $rim.append(`<option value="${rim['id']}">${rim['size']}</option>`).prop("disabled", false);
        })
    })
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
