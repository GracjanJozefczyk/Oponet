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
    url: "/admin/tires/brands/uploadImage",
    maxFiles: 1,
    dictDefaultMessage: "Drop Brand Logo here...",
    addRemoveLinks: true,
    init: function () {
        this.on("success", function (file, response) {
            $("#tire_brand_form_imageUrl").val(response.filename);
            $("#old_brand_image").hide();
        })
    },
    transformFile: function (file, done) {
        $("#modal").modal('show');

        // Load the image
        var image = new Image();
        image.src = URL.createObjectURL(file);
        image.className = "img-fluid";
        image.id = "cropper_image";
        $("#cropper").prepend(image);

        const cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            background: false,
            modal: false
        });

        var myDropZone = this;

        $("#cropperSave").click(function () {
            var canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200
            });

            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function (blob) {
                // Update the image thumbnail with the new image data
                myDropZone.createThumbnail(
                    blob,
                    myDropZone.options.thumbnailWidth,
                    myDropZone.options.thumbnailHeight,
                    myDropZone.options.thumbnailMethod,
                    false,
                    function (dataURL) {

                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);

                        // Return modified file to dropzone
                        done(blob);
                    }
                );
            });
            $("#modal").modal('hide');
        });
    },
});

$("#modal").on("hide.bs.modal", function (event) {
    // TODO delete cropper
    console.log('test');
});