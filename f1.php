<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulář</title>
</head>
<body>

<?php
if (!($con = mysqli_connect("sql6.webzdarma.cz","renepodpinka4242","HesloMySQL1!","renepodpinka4242")))
{
	die("Nelze se připojit k databázovému serveru!</body></html>");
}
mysqli_query($con,"SET NAMES 'utf8'");
// VLOŽENÍ NOVÉHO DOTAZU DO DB
if (isset($_POST['quest_text'])){
    mysqli_query($con,
            "INSERT INTO survey_questions(question_text) VALUES('" .
            addslashes($_POST["quest_text"]) . "')");
}
    // VYPSÁNÍ DO SOUBORU  
    $vysledek=mysqli_query($con,"SELECT question_text, question_id from survey_questions");
    if (mysqli_num_rows($vysledek)>0){
        while ($radek = mysqli_fetch_array($vysledek)){
            ?>
            <p><?php echo "Otázka č. ".$radek['question_id']."zní: ". $radek['question_text']." - <a href='theQuestion.php?id=".$radek['question_id']."'";?>>Detail</a></p>

            <?php
    }
            }
mysqli_close($con); 
?>
    <h2>Ahoj, napiš mi svou otázku</h2>
    <form action="f1.php" method="POST">
        <textarea name="quest_text" cols="30" rows="10"></textarea><br>
    <input type="submit" value="Odešli otázku">
    </form>
</body>
</html>