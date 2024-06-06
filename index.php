<?php
session_start();

$_SESSION['score'] = 0;

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notizia Vera O Fake News?</title>
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
            align-items: center;
            justify-content: flex-start;
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
            margin-top: -10vh;
            margin-bottom: -20vh;
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
        }

        .b {
            z-index: 10000;
            margin-top: 10vh;
            color: rgb(255, 255, 255);
            font-size: 8vh;
            text-decoration: none;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            width: 20vw;
            height: 15vh;
            background-color: rgb(248, 98, 98);
            border: 1vh solid rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: .2s;
        }

        .b:hover {
            width: 40vw;
            height: 30vh;
            font-size: 30vh;
            border: .3vh solid rgb(255, 255, 255);
            color: rgb(255, 255, 255);
            -webkit-box-shadow: 0px 0px 50px 7px #FFFFFF;
            box-shadow: 0px 0px 50px 7px #FFFFFF;
        }

        .a {
            position: absolute;
            top: 1vh;
            right: 2.7vh;
            z-index: 10000;
            color: rgb(255, 255, 255);
            font-size: 5vh;
            text-decoration: none;
            font-family: Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            width: 5vw;
            height: 5vw;
            background-color: rgb(248, 98, 98);
            border: 1vh solid rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: .2s;
        }

        .a:hover {
            color: rgb(255, 255, 255);
            -webkit-box-shadow: 0px 0px 50px 7px #FFFFFF;
            box-shadow: 0px 0px 50px 7px #FFFFFF;
        }

        @media (orientation:portrait) {
            .a {
                top: 1vh;
                width: 5vh;
                height: 5vh;
            }

            .b {
                width: 70vw;
                height: 15vh;
            }

            .b:hover {
                width: 80vw;
                height: 20vh;
                font-size: 30vw;
            }
        }
    </style>
</head>

<body>
    <div id="sfondo"></div>
    <div id="blur"></div>
    <a href="info.html" class="a">?</a>
    <div id="contain">
        <a href="index.php" class="logo"><img id="logo" src="src/logo.svg" alt=""></a>
        <a href="gioco.php" class="b">GIOCA</a>
    </div>
</body>

</html>