 <!DOCTYPE html>
 <html>

 <body>

   <?php
    echo "My first PHP script!";
    ?>
   <br>
   <?php
    define('NAME', 'value');
    echo "I am a constant", NAME;
    ?>
   <br>
   <?php
    echo "I am a magic constant", __FILE__;
    ?>
   <br>
   <?php
    $new = "shell.jpg.php";


    echo $new;
    ?>
 </body>

 </html>