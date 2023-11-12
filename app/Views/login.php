<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS via CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Login Page</title>
</head>

<body>
    <div class="container mt-4">
        <?php
        if (!empty(session()->getFlashdata("success"))) {
            ?>
            <div class="alert alert-success">
                <?php
                echo session()->getFlashdata("success")
                    ?>
            </div>
            <?php
        } else if (!empty(session()->getFlashdata("error"))) {
            ?>
                <div class="alert alert-danger">
                    <?php
                    echo session()->getFlashdata("error")
                        ?>
                </div>

            <?php
        }

        ?>
        <h1 class="text-center">Login</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="background-color: #3498db;">

                        <form method="post" action="<?= base_url('login') ?>">
                            <?php csrf_field() ?>
                            <div class="mb-3 mt-4">

                                <input type="email" class="form-control" placeholder="Username/Email" name="email">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'email') : "" ?>
                                </span>
                            </div>
                            <div class="mb-3 mt-4">

                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'password') : "" ?>
                                </span>

                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>

                            <div class="mb-3">
                                <span>
                                    <a href="#">
                                        forgotten your password
                                    </a>
                                </span>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS via CDN (optional, if needed for other functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>