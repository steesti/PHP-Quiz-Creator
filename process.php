<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php 
//Check if score setlocale
if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if($_POST){
    $number = $_POST['number'];
    $selected_choice = $_POST['choice'];
    $next = $number + 1;
    
    //Get total
    $query = "SELECT * FROM questions";
    $results = $mysqli->query($query) or die($mysql->error.__LINE__);
    $total = $results->num_rows;
    
    //Get correct choice & result
    $query = "SELECT * FROM `choices` WHERE question_number=$number AND is_correct=1";
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
    
    $row = $result->fetch_assoc();
    $correct_choice = $row['id'];
    
    if($correct_choice == $selected_choice){
			//Answer is correct
			$_SESSION['score']++;
		}
    
    //Check last question
    if($number == $total){
        header("Location: final.php");
        exit();
    }
    else{
        header("Location: question.php?n=$next");
    }
    
    
    echo $number . '<br>';
    echo $selected_choice;
}