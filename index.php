<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test-collabim</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <div class="container">
    <form action="index.php" method="get" class="search-bar">
      <input type="text" name="q" placeholder="Search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <br>
  </div>
  <div class="content">
  <?php 
    include('simple_html_dom.php');
    $input = urlencode($_GET["q"] ?? null) ;

    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/search?q='.$input);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);


    $domResults = new simple_html_dom();
    $domResults->load($result);

    foreach($domResults->find('a[href^=/url?]') as $link)
      echo utf8_encode($link->plaintext . '<br>')
  ?>
  </div>


</body>
</html>