<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>--Portfolio--</title>
    <script src="https://kit.fontawesome.com/c1d0ab37d6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="/images/logo.jpg">
</head>
<body>
    <header>
        <nav>
            <a href="/" class="logo">PORTFOLIO LILIAN ORTEGA</a>
            <div class="links">
                <a href="/" class="icon" title="Accueil"><i class="fas fa-home"></i></a>

                <a href="https://github.com/LilwenGo" class="icon" title="Mon GitHub" target="_blank"><i class="fab fa-github"></i></a>

                <a href="https://www.linkedin.com/in/lilian-ortega-1536a22ba" class="icon" title="Mon LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a>
                <?php
                if (isset($_SESSION["user"]["username"])) {
                    ?>
                        <a href="/lp-admin/admins" class="icon"><i class="fas fa-users-cog"></i></a>
                        <a href="/logout" class="icon"><i class="fas fa-power-off"></i></a>
                    <?php
                }
            ?>
            </div>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>
</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
