<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Welcome</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <?php if (session()->get('user_id')): ?>
                        <a class="nav-link" href="<?= session()->destroy() ?>">Logout</a>
                    <?php else: ?>
                        <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                    <?php endif; ?>
                </li>


            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 style="col-20">
            List of All Users
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

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <script>
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