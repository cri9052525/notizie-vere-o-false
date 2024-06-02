<?php

session_start();






$score = $_SESSION['score'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['nickname'])) {

        $nickname = htmlspecialchars($_POST['nickname']);


        $data = "$nickname|$score" . PHP_EOL;
        file_put_contents('leaderboard.txt', $data, FILE_APPEND);


        header("Location: leaderboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punteggio</title>
    <style>
        #sfondo {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('src/indexWP.jpg');
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

        p {
            margin-top: 10vh;
            background-color: white;
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        button {
            border: 0.2 solid black;
            margin: 1vh;
            background-color: white;
            width: 30vw;
            height: 15vh;
            font-size: 6vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

        #logoLink {
            z-index: 99;
        }
        h1{
            margin-top: 10vh;
            background-color: white;
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        label{
            background-color: white;
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        input{
            margin-left:2vh;
            background-color: white;
            font-size: 4vh;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            height: 5vh;
            border: 0;
            color: rgb(248, 98, 98);
            z-index: 1000;
        }
        form{
            z-index: 1000;
            display: flex ;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .clutter{
            z-index: 1000;
            margin: 5vh;
            display:flex;
        }
    </style>
</head>

<body>
    <div id="sfondo"></div>
    <div id="blur"></div>
    <div id="contain">
        <a href="index.php" id="logoLink"><img id="logo" src="src/logo.svg" alt=""></a>
        <h1>Il tuo punteggio: <?php echo $score; ?></h1>
        <form method="POST">
            <div class="clutter">
            <label for="nickname">Inserisci il tuo nickname:</label><br>
            <input type="text" id="nickname" name="nickname" required><br>
            </div>
            <button type="submit">Salva il punteggio</button>
        </form>
    </div>
</body>

</html>