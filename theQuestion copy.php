<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Question</title>
</head>
<body>
    <h2>Znění položené otázky</h2>
   <?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    if (!($con = mysqli_connect("sql6.webzdarma.cz","renepodpinka4242","HesloMySQL1!","renepodpinka4242")))
        {
        die("Nelze se připojit k databázovému serveru!</body></html>");
        }
    mysqli_query($con,"SET NAMES 'utf8'");
    $vysledek = mysqli_query($con, "SELECT * FROM survey_questions where question_id='$id'");
    while ($radek = mysqli_fetch_array($vysledek))
        {
        echo $radek['question_text'];
        }    
  
?>
    <form action="theQuestion.php?id=<?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            echo addslashes($id);
        }?>"
     method="POST">
        <textarea name="answer_text" cols="30" rows="10"></textarea> <br>
        <input type="hidden" name="question_id" value=<?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            echo '"'.addslashes($id).'"';
        }?>/>
        <input type="submit" value="Odešli odpověď">
    </form>
<?php
$con = mysqli_connect("sql6.webzdarma.cz","renepodpinka4242","HesloMySQL1!","renepodpinka4242");
   if (isset($_POST['answer_text'])){
    mysqli_query($con,
            "INSERT INTO survey_answers(question_id,answer_text) VALUES('" .
            addslashes($_POST["question_id"]) . "', '" .
            addslashes($_POST["answer_text"]) . "')");

            echo ("Odpověď vložena");
        }
        // VYPSÁNÍ ODPOVĚDÍ K OTÁZCE
 
        $vysledek=mysqli_query($con,"SELECT * from survey_answers where question_id=$id");
      
        while ($radek=mysqli_fetch_array($vysledek)){
    ?>
      <p><?php echo $radek['answer_text'];?></p>  
      
        
      <?php
     
    }
    
    
    
    
mysqli_free_result($vysledek);
mysqli_close($con);
}  
?>

</body>
</html>