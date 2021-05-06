import $ from "jquery";
import 'bootstrap';

import SimpleMDE from "simplemde";
import 'simplemde/dist/simplemde.min.css';
import Dropzone from "dropzone";
import 'dropzone/dist/dropzone.css';
import Cropper from "cropperjs";
import 'cropperjs/dist/cropper.css';

let simplemde = new SimpleMDE({
    element: $('#tire_brand_form_description')[0],
    toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "link", "table", "|", "preview"]
});

Dropzone.autoDiscover = false;

let myDropzone = new Dropzone("#dropzone", {
    acceptedFiles: 'image/*',
    // maxFiles: 1,
    parallelUploads: 1,
    dictDefaultMessage: "Drop Brand Logo here...",
    addRemoveLinks: true,
    init: function () {
        this.on("success", function (file, response) {
            $("#tire_brand_form_imageUrl").val(response.filename);
            $("#old_brand_image").hide();
            $("#modal").modal('hide');
        });
        this.on("removedfile", function (file) {
            console.log(file);
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
                width: 200,
                height: 200
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
        });
    }
});