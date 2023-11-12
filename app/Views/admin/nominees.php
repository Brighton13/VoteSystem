<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <style>
        /* Custom styles for the table */
        .table-container {
            margin-top: 20px;
        }

        .table-container h2 {
            margin-bottom: 10px;
        }

        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
    </style>

    <title>Nominees</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand" href="<?= site_url('Admin') ?>">BBVOTING SYSTEMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if (session()->get('role') == 'admin'): ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('Admin') ?>">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('Admin/AllUsers') ?>">SYSTEM USERS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('Admin/Results') ?>">ELECTION RESULTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('Admin/Registration') ?>">REGISTER USER</a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('User') ?>">HOME</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div>
            <ul class="navbar-nav">
                <li class=nav-item>
                    <p>Welcome
                        <?php echo ' ' . session()->get('name') ?>
                    </p>
                </li>
                <li class="nav-item">
                    <?php if (session()->get('role') == 'admin'): ?>
                        <a class="nav-link" href="<?= base_url('logout') ?>">LOGOUT</a>
                    <?php else: ?>

                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Nominees List</h1>
    </div>

    <div class="container table-container">
        <?php
        use App\Models\Category;

        if (!empty(session()->getFlashdata("success"))) {
            ?>
            <div class="alert alert-success">
                <?php
                echo session()->getFlashdata("success");
                ?>
            </div>
            <?php
        } else if (!empty(session()->getFlashdata("error"))) {
            ?>
            <div class="alert alert-danger">
                <?php
                echo session()->getFlashdata("error");
                ?>
            </div>
            <?php
        }
        ?>

        <?php if ($categories) : ?>
            <?php foreach ($categories as $category) : ?>
                <?php
                $categoryHasNominees = false;
                foreach ($users as $nominee) {
                    if ($nominee->category_id === $category['id']) {
                        $categoryHasNominees = true;
                        break;
                    }
                }
                ?>

                <?php if ($categoryHasNominees) : ?>
                    <div class="table-responsive">
                        <h2><?php echo $category['name']; ?></h2>
                        <table class="table table-bordered">
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
                                <?php foreach ($users as $nominee) : ?>
                                    <?php if ($nominee->category_id === $category['id']) : ?>
                                        <tr>
                                            <td>
                                                <img src="<?= base_url('images/' . $nominee->avarta); ?>"
                                                    class="img-thumbnail" alt="Avatar">
                                            </td>
                                            <td><?= $nominee->name ?></td>
                                            <td><?= $nominee->email ?></td>
                                            <td><?= $nominee->age ?></td>
                                            <td>
                                                <a href="<?= base_url('Admin/DeleteUser/' . $nominee->user_id); ?>"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No categories with nominees found.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap and other scripts -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>






<?php /*
<!-- <!doctype html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

<title>Nominees</title>
</head>

<body>
<header>
<nav>

</nav>
</header>
<div class="container">
<h1 style="col-20">
Nominees List
</h1>
</div>
<div class="container">
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
<div class="row">
<?php if ($nominees) ?>
<?php foreach ($nominees as $nominee): ?>
<div class="card" style="width: 18rem; margin: 20px;">
<img src=<?= base_url('images/brighton.jpg') ?> class=" card-img-top" alt="...">
<div class="card-body">
<h5 class="card-title">

<?php echo $nominee["name"] ?>
</h5>
<p class="card-text">

<?php echo $nominee["email"] ?>
</p>
<p class="card-text">
Age:
<?php echo $nominee["age"] ?>
</p>
<div class="container">
<div class="row">


<a href="<?php echo base_url('vote/nominee/' . $nominee['id']); ?>"
class="disable-buttons btn btn-primary" style="margin: 10px;">Vote</a>
</div>
</div>

</div>
</div>

<?php endforeach; ?>
</div>
</div>

<script>
const disableButtons = document.querySelectorAll('.disable-buttons');
let isUndoMode = false;

disableButtons.forEach(button => {
button.addEventListener('click', () => {
if (!isUndoMode) {
// Disable all buttons except the one clicked
disableButtons.forEach(btn => {
if (btn !== button) {
btn.disabled = true;
}
});

// Change the text and action of the clicked button to "Undo"
button.textContent = 'Undo';
isUndoMode = true;
} else {
// Restore all buttons
disableButtons.forEach(btn => {
btn.disabled = false;
});

// Change the text and action of the clicked button back to "Disable Others"
button.textContent = 'Vote';
isUndoMode = false;
}
});
});
</script>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
-->
</body>

</html> -->*/