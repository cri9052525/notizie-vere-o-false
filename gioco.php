<?php
error_reporting(0);
session_start();

$feedback = "";


if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}


$json_file_path = 'data.json';


if (file_exists($json_file_path) && is_readable($json_file_path)) {

    $notizie_json = file_get_contents($json_file_path);


    $notizie = json_decode($notizie_json, true);


    if (!isset($_SESSION['notizia_casuale'])) {

        $_SESSION['notizia_casuale'] = $notizie[array_rand($notizie)];
        unset($_POST['user_answer']);
    }

    $notizia_casuale = $_SESSION['notizia_casuale'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_answer = isset($_POST['user_answer']) ? $_POST['user_answer'] : null;
        if ($user_answer !== null) {
            $is_real = $notizia_casuale['real'] ? 'true' : 'false';
            if ($user_answer === $is_real) {

                $_SESSION['score']++;
                $feedback = "Corretto! La notizia è " . ($notizia_casuale['real'] ? "vera. " . "<a href='" . $notizia_casuale['link'] . "'>Se non ci credi controlla...</a>" : "falsa.");
            } else {
                $feed2 = "Sbagliato! La notizia è " . ($notizia_casuale['real'] ? "vera. " . "<a href='" . $notizia_casuale['link'] . "'>Se non ci credi controlla...</a>" : "falsa.");
                $_SESSION["ragemsg"] = $feed2;
                unset($_SESSION['notizia_casuale']);
                header("Location: punteggio.php");
                exit();
            }


            unset($_SESSION['notizia_casuale']);
        }
    }
} else {

    $notizia_casuale = null;
    $feedback = "Errore: il file delle notizie non è disponibile.";
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notizia Vera o Fake News?</title>
    <style>
        #sfondo {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: linear-gradient(<?php echo rand(0,360);?>deg, rgba(<?php echo rand(0,255);?>,<?php echo rand(0,255);?>,<?php echo rand(0,255);?>,1) 0%, rgba(<?php echo rand(0,255);?>,<?php echo rand(0,255);?>,<?php echo rand(0,255);?>,1) 100%);
            backdrop-filter: blur(5vh);
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            z-index: -5000;
        }

        #blur {
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            z-index: -4000;
            backdrop-filter: blur(1vh);
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            overflow-x: hidden;
        }

        #contain {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            width: 100vw;
            overflow-y: scroll;
        }

        #logo {
            margin-top: -15vh;
            margin-bottom: -30vh;
            height: 70vh;
            width: 70vw;
            filter: invert(100%)hue-rotate(180deg);
            z-index: 99;
        }

        #logoLink {
            z-index: 99;
        }

        p {
            margin-top: 0vh;
            background-color: white;
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        form {
            z-index: 1000;
        }

        button {
            border: 0.2 solid black;
            margin: 1vh;
            background-color: white;
            width: 30vw;
            height: 15vh;
            font-size: 6vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            z-index: 1000;
            cursor: pointer;
        }
        @media (orientation:portrait) {
            #next{
                width: 30vh;
            }
            #contain{
                padding: 2vw;
                width: 96vw;
            }
            #logo{
                height: 100vh;
                width: 50vh;
                margin-top: -30vh;
                margin-bottom: -52vh;
            }
        }
    </style>
</head>

<body>
    <div id="sfondo"></div>
    <div id="blur"></div>
    <div id="contain">
        <a href="index.php" id="logoLink"><img id="logo" src="src/logo.svg" alt=""></a>
        <?php if ($notizia_casuale) : ?>
            <p style="margin-top: 10vh;"><?php echo htmlspecialchars($notizia_casuale['titolo']); ?></p>

            <form method="POST">
                <button type="submit" name="user_answer" value="true">Vera</button>
                <button type="submit" name="user_answer" value="false">Falsa</button>
            </form>

            <?php if ($feedback) : ?>
                <p><?php echo $feedback; ?></p>
            <?php endif; ?>
        <?php else : ?>
            <p><?php echo $feedback; ?></p>
        <?php endif; ?>

        <p style="color:rgb(248, 98, 98); margin-top:0;">Punteggio: <?php echo $_SESSION['score']; ?></p>

        <?php if ($feedback && $notizia_casuale) : ?>
            <form method="POST" action="gioco.php">
                <button id="next" type="submit" name="next_question">Prossima Domanda</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>