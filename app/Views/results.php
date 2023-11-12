<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vote Results</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

</head>
<!-- results.php (your HTML view) -->

<style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .card {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    /* Add a style to hide the nav element when generating PDF */
    @media print {

        div,
        nav {
            display: none !important;
        }
    }
</style>


<div>
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
</div>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Vote Results</h1>
        <?php foreach ($categories as $category): ?>
            <?php
            // Check if there are results for the current category
            $categoryResults = array_filter($results, function ($result) use ($category, $nomineeModel) {
                $nominee = $nomineeModel->find($result['user_id']);
                return $nominee->category_id === $category['id'];
            });

            if (!empty($categoryResults)):
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <?= $category['name'] ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nominee Name</th>
                                    <th>Vote Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Sort categoryResults array in descending order based on vote_count
                                usort($categoryResults, function ($a, $b) {
                                    return $b['vote_count'] - $a['vote_count'];
                                });
                                ?>
                                <?php foreach ($categoryResults as $result): ?>
                                    <?php $nominee = $nomineeModel->find($result['user_id']); ?>
                                    <tr>
                                        <td>
                                            <?= $nominee->name ?>
                                        </td>
                                        <td>
                                            <?= $result['vote_count'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- Add a script section to remove unwanted elements before rendering PDF -->


    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>