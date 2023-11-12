<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Users list</title>
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
    <div class="container">
        <h1 style="col-20">
            List of All Users
        </h1>
    </div>
    <div class="container mt-4">
        <?php if (!empty(session()->getFlashdata("success"))): ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata("success") ?>
            </div>
        <?php elseif (!empty(session()->getFlashdata("error"))): ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata("error") ?>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php if ($user->role !== "admin"): ?>
                        <tr>
                            <td><img style="width:200px; height:200px;" src="<?= base_url('images/' . $user->avarta) ?>"
                                    class="img-thumbnail" alt="Avatar"></td>
                            <td>
                                <?= $user->name ?>
                            </td>
                            <td>
                                <?= $user->email ?>
                            </td>
                            <td>
                                <?= $user->age ?>
                            </td>
                            <td>
                                <form action="<?= base_url('Admin/Nominate/User/' . $user->user_id); ?>" method="post"
                                    class="d-inline">
                                    <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                                    <input type="hidden" name="category_id">
                                    <select name="category_id" class="form-select">
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['id']; ?>">
                                                <?= $category['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-success">Nominate</button>
                                </form>
                                <a href="<?= base_url('Admin/EditUser/' . $user->user_id); ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('Admin/DeleteUser/' . $user->user_id); ?>"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>