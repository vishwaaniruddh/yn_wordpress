<?php
// Set content type
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site Taken Down by OXIESEC</title>
    <style>
        /* Dark background with animated fade-in and glowing effects */
        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at top, #000000 0%, #0a0a0a 100%);
            overflow-x: hidden;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            animation: fadeIn 2s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h1, h2, h3 {
            text-align: center;
            margin: 20px 0;
        }

        .flag {
            width: 150px;
            animation: wave 3s infinite;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        @keyframes wave {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(3deg); }
            100% { transform: rotate(0deg); }
        }

        .message {
            text-align: center;
            font-size: 1.2em;
            margin: 20px auto;
            width: 90%;
            max-width: 600px;
            background: #111;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px #00ff00;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from { box-shadow: 0 0 10px #00ff00; }
            to { box-shadow: 0 0 20px #00ff00, 0 0 30px #00ff00; }
        }

        footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
            margin-top: 50px;
        }

        /* Make audio invisible */
        #quranAudio {
            position: absolute;
            width: 0;
            height: 0;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <h1>🚀 Site Taken Down by <span style="color:#00ff00;">OXIESEC</span></h1>

    <img src="https://upload.wikimedia.org/wikipedia/commons/0/00/Flag_of_Palestine.svg" alt="Palestine Flag" class="flag">

    <div class="message">
        <h2>🇵🇸 FREE PALESTINE 🇵🇸</h2>
        <p>Until Palestine is free, our hearts will remain restless. #FreePalestine</p>
    </div>

    <!-- Streaming Quran Audio - hidden -->
    <audio id="quranAudio" autoplay loop preload="auto">
        <source src="https://download.quranicaudio.com/quran/mishary_al_afasy/001.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <footer>
        Powered by OXIESEC | Justice for Palestine 🌍
    </footer>

    <script>
    // Make sure audio plays without user interaction (for mobile browser policies)
    window.addEventListener('load', function() {
        var audio = document.getElementById('quranAudio');
        audio.play().catch(function(e) {
            console.log('AutoPlay prevented, user must interact');
        });
    });
    </script>

</body>
</html>
