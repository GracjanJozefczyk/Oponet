import '../../styles/store.css';
import $ from "jquery";

$("#srcRim").change(function () {
    $.ajax({
        url: '/api/getwidths/' + $(this).val(),
        method: 'POST'
    }).done(function (data) {
        $("#srcWidth").empty();
        data.forEach(car => {
            $("#srcWidth").prepend(`<option value="${car['id']}">${car['width']}</option>`);
            $("#srcWidth").prop("disabled", false);
            console.log(car['width'], car['id']);
        });
    });
});

$("#srcWidth").change(function () {
    $.ajax({
        url: '/api/getheights/' + $(this).val(),
        method: 'POST'
    }).done(function (data) {
        $("#srcHeight").empty();
        data.forEach(car => {
            $("#srcHeight").prepend(`<option value="${car['id']}">${car['height']}</option>`);
            $("#srcHeight").prop("disabled", false);
            console.log(car['height'], car['id']);
        })
    })
})
