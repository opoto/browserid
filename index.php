<!DOCTYPE html>
<html>
    <head>
        <title>Persona Demo</title>
    </head>
    <body>
        <p>
            <?php
                session_start();
                // get user from session
                $user = $_SESSION['user'];
                // compute javascript value
                if ( $user ) {
                    $curUser = "'".$user."'";
                } else {
                    $curUser = "null";
                }
            ?>
        </p>
        <h1>Welcome to BrowserID demo</h1>
        
        <?php if ($user) { ?>

            <h2>How are you <?php echo $user ?>?</h2>
            <p><a id="logout" href="#">Logout</a></p>
        
        <?php } else { ?>

            <h2>Have we already met?</h2>
            <p><a id="login" href="#">Login</a></p>

        <?php } ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
        <script src="https://login.persona.org/include.js"></script>

        <script>
            var currentUser = <?php echo $curUser; ?>;
        </script>
        <script src="app.js"></script>
    </body>
</html>
