import $ from "jquery";
import 'bootstrap';
import 'jquery-ui/ui/widgets/autocomplete';
import 'jquery-ui/themes/base/all.css';

$("#find_brand").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "/api/getbrands",
            dataType: "json",
            data: {
                term: request.term
            },
            success: function (data) {
                response (data)
            }
        });
    },
    minLength: 1
})

$("#find_brand").change(function () {
    $("#find_model").empty().prop("disabled", true).append('<option value="null">Choose model</option>');
    $.ajax({
        url: '/api/getmodelsbybrand',
        method: 'GET',
        data: {
            term: $("#find_brand").val()
        },
    }).done(function (data) {
        var x;
        for (x in data) {
            $("#find_model").append(`<option value="${data[x]}">${data[x]}</option>`).prop("disabled", false);
        }
    });
});
