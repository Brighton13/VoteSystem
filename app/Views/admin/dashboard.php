<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Dashboard</title>
</head>
<style>
    /* Add your custom styles here */

    body {
        text-align: center;
    }

    .navbar {
        justify-content: center;
    }

    .navbar-nav {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .navbar-nav .nav-item {
        margin: 0 10px;
    }

    .navbar-nav .nav-item a {
        padding: 10px 20px;
        border: 2px solid #007BFF;
        border-radius: 5px;
        color: #007BFF;
    }

    .navbar-nav .nav-item a:hover {
        background-color: #007BFF;
        color: #fff;
    }

    .container h1 {
        margin-top: 50px;
    }

    .dashboard-table {
        width: 100%;
        margin-top: 20px;
    }

    .dashboard-table td {
        text-align: center;
    }

    .dashboard-table a {
        display: block;
        padding: 10px;
        border: 2px solid #007BFF;
        border-radius: 5px;
        color: #007BFF;
        text-decoration: none;
    }

    .dashboard-table a:hover {
        background-color: #007BFF;
        color: #fff;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('Admin') ?>">BBVOTING SYSTEMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarNav">
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
            </div> -->
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
            ADMIN DASHBOARD
        </h1>
    </div>

    <div class="container">
        <?php
        if (!empty(session()->getFlashdata("success"))) {
            ?>
            <div class="alert alert-success" id="flash-message">
                <?php
                echo session()->getFlashdata("success")
                    ?>
            </div>
            <?php
        } else if (!empty(session()->getFlashdata("error"))) {
            ?>
                <div class="alert alert-danger" id="flash-message">
                    <?php
                    echo session()->getFlashdata("error")
                        ?>
                </div>

            <?php
        }

        ?>

    </div>
    <div class="container mt-4">

        <table class="dashboard-table">
            <tr>
                <td><a href="<?= site_url('Admin') ?>">HOME</a></td>
                <td><a href="<?= site_url('Admin/AllUsers') ?>">SYSTEM USERS</a></td>
                <td><a href="<?= site_url('Admin/AllNominees') ?>">NOMINEES</a></td>
                <td><a href="<?= site_url('Admin/Vote') ?>">VOTE</a></td>
                <td><a href="<?= site_url('Admin/Results') ?>">ELECTION RESULTS</a></td>
                <td><a href="<?= site_url('Admin/Registration') ?>">REGISTER USER</a></td>
            </tr>
        </table>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <script>

        // Auto-dismiss flash message after 5 seconds (5000 milliseconds)
        $(document).ready(function () {
            setTimeout(function () {
                $("#flash-message").fadeOut("slow");
            }, 5000);
        });


        // Add an event listener to the select element
        $('#category').on('change', function () {
            var selectedValue = $(this).val(); // Get the selected value

            // Send the selected value to a CodeIgniter controller function via AJAX
            $.ajax({
                type: 'POST',
                url: 'AdminController/usernomination', // Replace with your controller and method
                data: { category_id: selectedValue }, // Send the selected value as a parameter
                success: function (response) {
                    // Handle the response from the controller if needed
                    console.log(response);
                }
            });
        });
    </script>

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

</html>