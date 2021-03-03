<?php
// File uploading from https://www.w3schools.com/php/php_file_upload.asp

// Check if image file is a actual image or fake image
if (isset($_POST["upload-new-file"])) {
  $target_dir = "../db/pictures/";
  $target_file = $target_dir . basename($_FILES["upload-new-file-chooser"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $check = getimagesize($_FILE["upload-new-file-chooser"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";

    // Check if file already exists
    if (file_exists($target_file) !== false) {
      // Check file size
      if ($_FILES["upload-new-file-chooser"]["size"] <= 500000) {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["upload-new-file-chooser"]["tmp_name"], $target_file))
          echo "The file " . htmlspecialchars(basename($_FILES["upload-new-file-chooser"]["name"])) . " has been uploaded.";
        else echo "Sorry, there was an error uploading yout file.";
      } else echo "Sorry, your file is too large.";
    } else  echo "Sorry, file already exists.";
  } else echo "File is not an image.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Waffle Toaster</title>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline';" />

    <!-- required stylesheets -->
    <link rel="stylesheet" href="./style/bootstrap.min.css" />
    <link rel="stylesheet" href="./style/main.css" />
    <link rel="stylesheet" href="./style/font-awesome.min.css" />
    <link rel="stylesheet" href="./style/lightgallery.css" />
    <link rel="stylesheet" href="./style/gallery.css" />
    <!--<link rel="stylesheet" href="./style/resizer.css" />-->

    <!-- required scripts -->
    <script src="./scripts/lib/jquery-3.5.1.min.js"></script>
    <script src="./scripts/lib/popper.min.js"></script>
    <script src="./scripts/lib/bootstrap.bundle.min.js"></script>
    <script src="./scripts/lib/lightgallery.js"></script>
    <!--<script src="./scripts/resizer.js"></script>-->
    <script src="./scripts/math.js"></script>
    <script src="./scripts/dragndrop.js"></script>
    <script src="./scripts/canvas.js"></script>
    <script src="./scripts/generators.js"></script>
    <script src="./scripts/rearrange.js"></script>
    <script src="./scripts/settings.js"></script>
    <script src="./scripts/modals.js"></script>
    <script src="./scripts/server.js"></script>
    <script src="./scripts/startup.js"></script>
</head>

<body>

    <!-- BEGIN HEADER -->

    <nav id="navbar" class="navbar navbar-expand navbar-light bg-light">
        <div id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" id="new-main-board" href="#" data-toggle="modal" data-target="#new-main-board-modal">New Main Board</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="open-settings" href="#" data-toggle="modal" data-target="#settings-modal">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="move-resize" href="#" data-mode="resize">Rearrange</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- END HEADER -->

    <div id="main-wrapper" class="wrapper">

        <!-- BEGIN SIDEBAR -->

        <div id="sidebar" class="bg-light">
            <ul class="list-unstyled components">
                <li>
                    <a href="#">Board</a>
                </li>
                <li>
                    <a href="#">Diagram</a>
                </li>
                <li>
                    <a href="#" id="combined-generator">Card</a>
                </li>

                <!-- Cards accordion
                <li>
                    <a href="#cards-components" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Cards</a>
                    <ul class="collapse list-unstyled" id="cards-components">
                        <li>
                            <a id="image-generator" href="#">Image</a>
                        </li>
                        <li>
                            <a id="text-generator" href="#">Text</a>
                        </li>
                        <li>
                            <a id="combined-generator" href="#">Combined</a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>

        <!-- END SIDEBAR -->

        <!-- BEGIN CANVAS -->

        <div id="canvas-wrapper" class="bg-light">
            <div id="canvas"></div>
        </div>

        <!-- END CANVAS -->

    </div>

    <!-- New Main Board Modal -->
    <div class="modal fade" id="new-main-board-modal" tabindex="-1" role="dialog" aria-labelledby="new-main-board-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centerd modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-main-board-modal-title">New Main Board</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body scrollbar">
                    <form id="new-main-board-form" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-4 col-form-label" for="new-main-board-name">Name</label>
                            <div class="col-8">
                                <input id="new-main-board-name" name="new-main-board-name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">Show Grid</label>
                            <div class="col-8">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="new-main-board-show-grid" id="new-main-board-show-grid-true" type="radio"
                                        class="custom-control-input" value="true" checked>
                                    <label for="new-main-board-show-grid-true" class="custom-control-label">yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="new-main-board-show-grid" id="new-main-board-show-grid-false" type="radio"
                                        class="custom-control-input" value="false">
                                    <label for="new-main-board-show-grid-false" class="custom-control-label">no</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label" for="new-main-board-canvas-size">Canvas size</label>
                            <div class="col-8">
                                <input id="new-main-board-canvas-size" name="new-main-board-canvas-size" placeholder="1000x1000"
                                    type="text" class="form-control" pattern="^([1-9][0-9]*)x([1-9][0-9]*)$" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label" for="new-main-board-grid-size">Grid cell size</label>
                            <div class="col-8">
                                <input id="new-main-board-grid-size" name="new-main-board-grid-size" placeholder="0.5"
                                    type="number" min="0" max="10" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save-new-main-board" class="btn btn-primary" data-dismiss="modal">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settings-modal" tabindex="-1" role="dialog" aria-labelledby="settings-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settings-modal-title">Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body scrollbar">
                    <form id="settings-form" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-4">Show Grid</label>
                            <div class="col-8">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="show-grid" id="show-grid-true" type="radio"
                                        class="custom-control-input" value="true">
                                    <label for="show-grid-true" class="custom-control-label">yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input name="show-grid" id="show-grid-false" type="radio"
                                        class="custom-control-input" value="false">
                                    <label for="show-grid-false" class="custom-control-label">no</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label" for="settings-canvas-size">Canvas size</label>
                            <div class="col-8">
                                <input id="settings-canvas-size" name="settings-canvas-size" placeholder="1000x1000"
                                    type="text" class="form-control" pattern="^([1-9][0-9]*)x([1-9][0-9]*)$">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label" for="settings-grid-size">Grid cell size</label>
                            <div class="col-8">
                                <input id="settings-grid-size" name="settings-grid-size" placeholder="0.5"
                                    type="number" min="0" max="10">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save-settings" class="btn btn-primary" data-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Combined edit Modal -->
    <div class="modal fade" id="edit-comb-modal" tabindex="-1" role="dialog" aria-labelledby="edit-comb-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-comb-modal-title">Edit Image card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body scrollbar">
                    <form id="edit-comb-form" class="form-horizontal">
                        <div class="form-group row">
                            <label for="edit-comb-card-title" class="col-4 col-form-label">Card title</label>
                            <div class="col-8">
                                <input id="edit-comb-card-title" name="edit-comb-card-title" placeholder="Card Title"
                                    type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit-comb-card-text" class="col-4 col-form-label">Text Area</label>
                            <div class="col-8">
                                <textarea id="edit-comb-card-text" name="edit-comb-card-text" cols="40" rows="5"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <button id="open-select-img-comb" type="button" style="margin: auto;"
                                class="btn btn-secondary text-center col-4" data-toggle="modal"
                                data-target="#uploaded-files-modal" data-dismiss="modal">Select image</button>
                            <button id="clear-img-comb" type="button" style="margin: auto;"
                                class="btn btn-danger text-center col-4">Clear image</button>
                        </div>
                        <div class="form-group row">
                            <div id="edit-comb-display"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="delete-edit-comb" class="btn btn-danger" data-toggle="modal"
                        data-target="#confirm-delete-modal" data-dismiss="modal">Remove</button>
                    <button type="button" id="save-edit-comb" class="btn btn-primary" data-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm delete Modal -->
    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog"
        aria-labelledby="confirm-delete-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-delete-modal-title">Confirm delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body scrollbar">
                    <p>Are you sure you want to delete <strong id="confirm-delete-target"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirm-delete" class="btn btn-danger"
                        data-dismiss="modal">Confirm</button>
                    <button type="button" id="cancel-delete" class="btn btn-secondary"
                        data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Already uploaded files Modal -->
    <div class="modal fade" id="uploaded-files-modal" tabindex="-1" role="dialog"
        aria-labelledby="uploaded-files-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document"
            style="max-width:80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploaded-files-modal-title">Uploaded files</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body scrollbar">
                    <form id="uploaded-files-form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group row container" style="margin:auto!important;">
                            <div id="uploaded-files-gallery-container"></div>
                        </div>
                        <div class="form-group row">
                            <div class="custom-file col" style="margin:0 .75em;">
                                <input type="file" name="upload-new-file-chooser" class="custom-file-input"
                                    id="upload-new-file-chooser">
                                <label for="upload-new-file-chooser" class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#edit-comb-modal"
                        data-dismiss="modal">Back</button>
                    <button type="submite" name="upload-new-file" id="upload-new-file" class="btn btn-primary" form="uploaded-files-form">Upload</button>
                    <button type="button" id="select-uploaded-file" class="btn btn-primary" data-toggle="modal"
                        data-target="#edit-comb-modal" data-dismiss="modal">Select</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
