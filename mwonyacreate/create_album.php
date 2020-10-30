<?php include("uploadscripts/albumupload.php");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YNG3P75VXH"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-YNG3P75VXH');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" href="../assets/images/musiclogo.png" type="image/png">

    <link rel="stylesheet" href="mwonyacreate.css">
    <title>Create Music Album</title>

</head>

<body>
    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Mwonya Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_artist.php">Create Artist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_podcast.php">Create Podcast</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="create_album.php">Create Music Album</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="create_poems.php">Create Poem Album</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_Dj.php">Create DJ</a>
                </li>


            </ul>

        </div>
    </nav>

    <div class="container mt-5">
        <!-- Display response messages -->
        <?php if (!empty($resMessage)) { ?>
        <div class="alert <?php echo $resMessage['status'] ?>">
            <?php echo $resMessage['message'] ?>
        </div>
        <?php } ?>
        <form action="" method="post" enctype="multipart/form-data" class="mb-3">
            <h3 class="text-center mb-5">New Mwonya Music Album</h3>

            <div id="imageholdingdiv" class="user-image mb-3 text-center" style="background-color: #dedede;">
                <div style="width: 100px; background:#dedede;height: 100px; overflow: hidden; margin: 0 auto">
                    <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
                </div>
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Album Title</label>
                <input type="text" name="AlbumTitle" class="form-control" id="exampleInputEmail1"
                    aria-describedby="nameHelp" placeholder="Enter Album Title">
            </div>
            <div class="form-group">
                <label for="inputState">Album Artist</label>
                <select name="artistselect" id="inputState" class="form-control">
                    <option selected>Choose Artist</option>
                    <?php foreach ($artists as $artist) : ?>
                    <option value="<?= $artist['id']; ?>"><?= $artist['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="inputState">Artist Genre</label>
                <select name="genreselect" id="inputState" class="form-control">
                    <option selected>Choose Genre</option>
                    <?php foreach ($genres as $genre) : ?>
                    <option value="<?= $genre['id']; ?>"><?= $genre['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputdescription">Album Description</label>
                <textarea type="textarea" name="description" class="form-control" id="exampleInputdescription"
                    aria-describedby="descriptionHelp" placeholder="Album Description"></textarea>
            </div>

            <div class="form-group">

                <div class="custom-file">
                    <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                    <label class="custom-file-label" for="chooseFile">Select Album Cover</label>
                </div>
            </div>



            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Create Album
            </button>
        </form>



    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('#imageholdingdiv').css('display', 'block');

            reader.onload = function(e) {
                $('#imgPlaceholder').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("form").on("change", ".file-upload-field", function() {
        $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
    });

    $("#chooseFile").change(function() {
        readURL(this);
    });
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
</body>

</html>