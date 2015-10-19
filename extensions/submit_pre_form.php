<?php // include the config
require_once('../config/config.php');

$db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
//TODO: remove
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $patient_id = $_POST[ 'patient_id' ];
  $submit_time = $_POST[ 'submit_time' ];
  $questions = $_POST[ 'questions' ];

echo "here";
  $remove_query = "DELETE FROM chris2.chris_pre WHERE user_id = :pid ;";
  try {
      $query_rmv1 = $db_connection->prepare($remove_query);
      $query_rmv1->bindValue(':pid', $patient_id, PDO::PARAM_INT);
      $query_rmv1->execute();
      echo "Here";
    } catch (Exception $e) {
      echo "ERROR:" .$e->getMessage();

    }

  $insert_query = "INSERT INTO chris2.chris_pre (user_id, submit_time, CPRQ1 ,  CPRQ2 , CPRQ3 , CPRQ4 , CPRQ5 , CPRQ6 , CPRQ7  ,
                 CPRQ8  , CPRQ9  , CPRQ10  , CPRQ11  , CPRQ12  , CPRQ13  , CPRQ14  , CPRQ15  , CPRQ16 , CPRQ17  ,
                 CPRQ18 , CPRQ19 , CPRQ20 ,  CPRQ21  , CPRQ22 ,  CPRQ23  , CPRQ24  , CPRQ25 , CPRQ26, submissionType
  ) VALUES
     (:USER_ID, :submit_time, :CPRQ1, :CPRQ2,:CPRQ3,:CPRQ4,:CPRQ5,:CPRQ6,:CPRQ7 ,
                :CPRQ8 ,:CPRQ9 ,:CPRQ10 ,:CPRQ11 ,:CPRQ12 ,:CPRQ13 ,:CPRQ14 ,:CPRQ15 ,:CPRQ16,:CPRQ17 ,
                :CPRQ18,:CPRQ19,:CPRQ20, :CPRQ21 ,:CPRQ22, :CPRQ23 ,:CPRQ24 ,:CPRQ25,:CPRQ26, 'paper' )";

                try {
                    $query_response1 = $db_connection->prepare($insert_query);
                    $query_response1->bindValue(':USER_ID', $patient_id, PDO::PARAM_INT);
                    $query_response1->bindValue(':submit_time', $submit_time, PDO::PARAM_STR);
					 $query_response1->bindValue(':CPRQ1', $questions[0], PDO::PARAM_INT);
					 $query_response1->bindValue(':CPRQ2', $questions[1], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ3', $questions[2], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ4', $questions[3], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ5', $questions[4], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ6', $questions[5], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ7', $questions[6], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ8', $questions[7], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ9', $questions[8], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ10', $questions[9], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ11', $questions[10], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ12', $questions[11], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ13', $questions[12], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ14', $questions[13], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ15', $questions[14], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ16', $questions[15], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ17', $questions[16], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ18', $questions[17], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ19', $questions[18], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ20', $questions[19], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ21', $questions[20], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ22', $questions[21], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ23', $questions[22], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ24', $questions[23], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ25', $questions[24], PDO::PARAM_INT);
					  $query_response1->bindValue(':CPRQ26', $questions[25], PDO::PARAM_INT);
					
                    $query_response1->execute();

                  } catch (Exception $e) {
                	  echo "ERROR:" .$e->getMessage();
                  }
				  
				  $query_paperflag = "INSERT INTO chris2.paperforms (patient_id) VALUES(:pprid);";
				  try{
				  $query_pprf = $db_connection->prepare($query_paperflag);
				  $query_pprf->bindValue(':pprid', $patient_id, PDO::PARAM_INT);
				  $query_pprf->execute();
    
					} catch (Exception $e) {
					  echo "ERROR:" .$e->getMessage();

					}
				  
                  
//end
  ?>
