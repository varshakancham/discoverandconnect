<html>
<head>
  <title>py script</title>
</head>

<body>
  <h1>Hey There!Python Working Successfully In A PHP Page.</h1>
  <?php
    $cmd = "python test.py 46";
    exec("$cmd", $output);
    echo $output[0].","; 
    echo $output[1].",";
    echo $output[2].","; 
    echo $output[3].",";
    echo $output[4];
   
     
    ?>
</body>
</html