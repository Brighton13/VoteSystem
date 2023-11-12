<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Bootstrap CSS via CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Edit User</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('Admin') ?>">BBVOTING SYSTEMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Admin') ?>">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Admin/AllUsers') ?>">SYSTEM USERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Admin/AllNominees') ?>">NOMINEES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Admin/Vote') ?>">VOTE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Admin/Results') ?>">ELECTION RESULTS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Admin/Registration') ?>">REGISTER USER</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <ul class="navbar-nav">

                <li class=nav-item>
                    <Span>WELCOME
                        <?php echo ' ' . session()->get('name') ?>
                    </Span>
                </li>
                <li class=nav-item>
                    <a class="nav-link" href="<?= base_url('logout') ?>">LOGOUT</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center">Edit User Details</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="background-color: #3498db;">

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

                        <form action="<?= base_url('Admin/Nominate/User/' . $user->user_id) ?>" method="post"
                            enctype="multipart/form-data">

                            <?php csrf_field() ?>

                            <div class="mb-3 mt-4">
                                <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'name') : "" ?>
                                </span>
                            </div>
                            <div class="mb-3 mt-4">

                                <input type="text" class="form-control" placeholder="FullName" name="name"
                                    value="<?= $user->name ?>">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'name') : "" ?>
                                </span>
                            </div>

                            <div class="mb-3 mt-4">

                                <input type="text" class="form-control" placeholder="Email" name="email"
                                    value="<?= $user->email ?>">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'email') : "" ?>
                                </span>
                            </div>

                            <div class="mb-3 mt-4">

                                <input type="text" class="form-control" placeholder="Age" name="age"
                                    value="<?= $user->age ?>">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'age') : "" ?>
                                </span>
                            </div>

                            <div class="mb-3 mt-4">

                                <input type="text" class="form-control" placeholder="MobileNumber" name="phone"
                                    value="<?= $user->phone ?>">
                                <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'phone') : "" ?>
                                </span>
                            </div>
                            <div class="mb-3 mt-4">

                                <input type="text" class="form-control" placeholder="profile image" name="avarta"
                                    value="<?= $user->avarta ?>">

                            </div>
                            <div class="mb-3 mt-4">

                                <input type="hidden" name="user_id" value="<?= $user->user_id; ?>">
                                <select name="category_id" class="form-select">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id']; ?>">
                                            <?= $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>



                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Nominate</button>
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