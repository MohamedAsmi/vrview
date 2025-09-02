$(document).on('click', '.drop', function () {
    $('.openfile').click();
});

let route = window.appRoutes.imageGet;
let token = $('meta[name="csrf-token"]').attr('content')


$(document).ready(function () {
    $.ajax({
        type: 'POST',
        _token: $('meta[name="csrf-token"]').attr('content'),
        url: route,
        datatype: 'json',
        success: function (response) {

            $(document).on('focusout', '#exampleInputPassword1', function () {

                $(this).closest("form").submit();
            });


            $('#room').append('<div class="col-6 text-center" id="loader" style="display:none;"><div class="rooms-types-uplox" id=""><i class="fad fa-spinner-third"></div></div>');
            $('#room').append('<div class="col-6 text-center"><div class="rooms-types-uplo" id=""><form id="UploadImage" enctype="multipart/form-data"><div class="drop" id="drop"><i id="plusicon" class="far fa-plus"></i><p>Upload 360 image</p></div><div class="text-center font-weight-bold"><button type="submit" id="uploadimages" class="btn btn-success" hidden>Upload image</button></div><input class="openfile" id="files" multiple="true" name="files[]" type="file" hidden/></form></div></div>');



            var $dropzone = document.querySelector('.drop');
            var input = document.getElementById('files');

            $dropzone.ondragover = function (e) {
                e.preventDefault();
                this.classList.add('dragover');
                $('.rooms-types-uplo').css({ "background-color": "lightgray", "border": "1px dashed gray", "margin-top": "4mm", "transition": "border-width 0.5s linear" });
            };
            $dropzone.ondragleave = function (e) {
                e.preventDefault();
                this.classList.remove('dragover');
                $('.rooms-types-uplo').css({ "background-color": "white", "border": "1px dashed gray", "margin-top": "4mm" });
            };
            $dropzone.ondrop = function (e) {
                e.preventDefault();
                this.classList.remove('dragover');
                input.files = e.dataTransfer.files;
                $("#files").trigger("change");
                $('.rooms-types-uplo').css({ "background-color": "white" });
            }

            function handleFileSelect(evt) {
                var files = evt.target.files;
                for (var i = 0, f; f = files[i]; i++) {
                    if (!f.type.match('image.*')) {
                        continue;
                    }
                    var reader = new FileReader();
                    reader.onload = (function (theFile) {
                        return function (e) {
                            var span = document.createElement('span');

                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
            }


            $('#files').change(handleFileSelect);
            $('#UploadImage').on('submit', async function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var decrtoken = $('#decrtoken').val();
                var property_id = $('#property_id').val();
                formData.append('decrtoken', decrtoken);
                formData.append('property_id', property_id);
                console.log(formData.file);
                // return;
                var uploadimage = await $.ajax({
                    type: 'POST',
                    url: window.appRoutes.imageupload,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {

                        $("#loader").show();
                    },
                    success: function (response) {
                        if (response.error) {
                            $("#loader").hide();
                            $('.rooms-types-uplo').css({ "border": "1px dashed red" });
                            $('p').css({ "color": "red" });
                            $('#plusicon').css({ "color": "red" });
                        } else {
                            window.location.reload();
                        }
                    }
                });
                e.stopImmediatePropagation();
                //return false;
                $("#files").empty();
            });
        }
    });
});

$(document).on('change', '#files', function () {
    $('#uploadimages').click();
    console.log('first trigger');
});