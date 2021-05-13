import $ from "jquery";
import 'bootstrap';

import SimpleMDE from "simplemde";
import 'simplemde/dist/simplemde.min.css';
import Dropzone from "dropzone";
import 'dropzone/dist/dropzone.css';
import Cropper from "cropperjs";
import 'cropperjs/dist/cropper.css';

let simplemde = new SimpleMDE({
    element: $('#tire_model_form_description')[0],
    toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "link", "table", "|", "preview"]
});

Dropzone.autoDiscover = false;

let myDropzone = new Dropzone("#dropzone", {
    acceptedFiles: 'image/*',
    parallelUploads: 1,
    dictDefaultMessage: "Drop Brand Logo here...",
    addRemoveLinks: true,
    init: function () {
        this.on("success", function (file, response) {
            console.log(file.upload.uuid);
            var newWidget = $("#tire_model_form_imagesUrls").attr("data-prototype");
            newWidget = newWidget.replace(/__name__/g, file.upload.uuid);
            newWidget = newWidget.replace(/__data__/g, response.filename);
            var form = $('form[name="tire_model_form"]');
            form.append(newWidget);
        });
        this.on("removedfile", function (file) {
            var bla = $(`input[id*="${file.upload.uuid}"]`).remove();
        });
    },
    transformFile: function (file, done) {

        var myDropZone = this;
        var image = new Image();
        image.src = URL.createObjectURL(file);
        image.style.setProperty('display', 'block');
        image.style.setProperty('max-width', '100%');
        $("#img_container").prepend(image);

        $("#modal").modal('show');

        var cropper = new Cropper(image, {
            aspectRatio: 1,
            background: false,
            modal: false
        });

        $("#cropperSave").click(function (){
            var canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 800
            });

            canvas.toBlob(function (blob) {
                myDropzone.createThumbnail(
                    blob,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    false,
                    function(dataURL) {
                        myDropZone.emit('thumbnail', file, dataURL);
                        done(blob);
                    }
                );
            });
            $("#img_container").empty();
            $("#modal").modal('hide');
        });
    }
});
