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