<!DOCTYPE html>
<html>

<head>
    <title>Upload Multiple Images without Page Refresh using jQuery Ajax and PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .gallery ul,
        .gallery ol,
        .gallery li {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .upload-div {
            margin-bottom: 20px;
        }

        #uploadStatus {
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 18px;
        }

        .gallery {
            width: 100%;
            float: left;
        }

        .gallery ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .gallery ul li {
            padding: 7px;
            border: 2px solid #ccc;
            float: left;
            margin: 10px 7px;
            background: none;
            width: auto;
            height: auto;
        }

        .gallery img {
            width: 250px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Upload Multiple Images without Page Refresh using jQuery Ajax and PHP</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="upload-div">
                    <!-- File upload form -->
                    <form id="uploadForm" method="post" enctype="multipart/form-data" class="form-inline">
                        <div class="form-group">
                            <label>Choose Images: </label>
                            <input type="file" name="images[]" id="fileInput" class="form-control" multiple>
                        </div>
                        <input type="submit" name="submit" class="btn btn-success" value="UPLOAD" />
                    </form>
                </div>

                <!-- Display upload status -->
                <div id="uploadStatus"></div>
                <!-- Gallery view of uploaded images -->
                <div class="gallery"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // File upload via Ajax
            $("#uploadForm").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'upload.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#uploadStatus').html('<img src="img/loader.gif"/>');
                    },
                    error: function() {
                        $('#uploadStatus').html('<span style="color:#EA4335;">Images upload failed, please try again.<span>');
                    },
                    success: function(data) {
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<span style="color:#28A74B;">Images uploaded successfully.<span>');
                        $('.gallery').html(data);
                    }
                });
            });

            // File type validation
            $("#fileInput").change(function() {
                var fileLength = this.files.length;
                var match = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
                var i;
                for (i = 0; i < fileLength; i++) {
                    var file = this.files[i];
                    // console.log(file.type);
                    var imagefile = file.type;
                    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]))) {
                        alert('Please select a valid image file (JPEG/JPG/PNG/GIF).');
                        $("#fileInput").val('');
                        return false;
                    }
                }
            });
        });
    </script>
</body>

</html>