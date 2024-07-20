<!-- <?php
session_start();
$name = $_SESSION['name'];
?> -->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Ninja Pizza</title>
    <style>
    .brand {
        background: #cbb09c !important;
    }

    .brand-text {
        color: #cbb09c !important;
    }

    form {
        max-width: 460px;
        margin: 20px auto;
        padding: 20px;
    }
    </style>
</head>

<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Ninja Pizza</a>

            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li class="grey-text">
                    <?php echo $name ?>
                </li>
                <li>
                    <a href="add.php" class="btn brand z-depth-0">
                        Add a Pizza
                    </a>
                </li>
            </ul>
        </div>
    </nav>