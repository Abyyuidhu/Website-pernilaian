<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sentiment Suka-Suka Saya</title>
  <link href="css/pure-min.css" rel="stylesheet"/>
  <style>
    :root {
      --bg: #f5efe6;
      --text: #3e2c1c;
      --card: #fffaf3;
      --accent: #b58e5c;
      --border: #a77d4f;
      --shadow: rgba(0, 0, 0, 0.1);
    }

    body {
      background-color: var(--bg);
      color: var(--text);
      font-family: 'Georgia', serif;
      margin: 0 auto;
      width: 90%;
      padding: 15px;
    }

    .header {
      background-color: var(--card);
      padding: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 2px solid var(--border);
      border-radius: 10px;
      box-shadow: 0 4px 6px var(--shadow);
      margin-bottom: 25px;
    }

    .header-title {
      font-size: 1.7rem;
      font-weight: bold;
      text-align: center;
      flex-grow: 1;
      color: var(--text);
      text-shadow: 1px 1px #d9cbb3;
    }

    .logo {
      height: 60px;
      width: 60px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid var(--border);
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: var(--accent);
      font-style: italic;
      border-bottom: 2px dashed var(--accent);
      padding-bottom: 5px;
      width: fit-content;
      margin-left: auto;
      margin-right: auto;
    }

    form {
      background-color: var(--card);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid var(--border);
      box-shadow: 0 3px 5px var(--shadow);
      max-width: 700px;
      margin: 0 auto;
    }

    textarea {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      font-family: 'Georgia', serif;
      border: 1px solid #ccc;
      border-radius: 8px;
      resize: vertical;
      background-color: #fffef9;
      color: var(--text);
    }

    button {
      margin-top: 15px;
      padding: 10px 20px;
      font-size: 1rem;
      font-family: 'Georgia', serif;
      border: none;
      border-radius: 8px;
      background-color: var(--accent);
      color: white;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #a77d4f;
    }

    @media (max-width: 600px) {
      .header-title {
        font-size: 1.2rem;
      }

      .logo {
        height: 45px;
        width: 45px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <img src="pemkab.jpg" alt="Logo Pemkab Kendal" class="logo">
    <div class="header-title">Visualisasi Analisis Sentimen Aplikasi Pak Dalman</div>
    <img src="dukcapil.jpg" alt="Logo Dispendukcapil Kendal" class="logo">
  </header>

  <h2>Sentiment Analysis Pelanggan</h2>

  <form class="pure-form" method="post">
    <fieldset class="pure-group">
      <textarea name="kalimat" rows="5" placeholder="tulis saja disini oke..."></textarea>
    </fieldset>
    <button type="submit" name="submit">Uji Sentimen</button>
  </form>

</body>
</html>

<?php
if(isset($_POST['submit'])){
	if (PHP_SAPI != 'cli') {
		echo "<pre>";
	}

	$strings = array(
		1 => $_POST['kalimat'],
	);

	require_once __DIR__ . '/autoload.php';
	$sentiment = new \PHPInsight\Sentiment();

	$i=1;
	foreach ($strings as $string) {

		// calculations:
		$scores = $sentiment->score($string);
		$class = $sentiment->categorise($string);

		// output:
		if (in_array("pos", $scores)) {
		    echo "Got positif";
		}

		echo "\n\nHasil:";
		echo "\nKalimat: <b>$string</b>\n";
		echo "Arah sentimen: <b>$class</b>, nilai: ";
		// var_dump($scores);
		foreach ($scores as $skor) {
			echo $skor;
		}
		echo "\n\n";
		$i++;
	}
}
?>