<?php
//if(isset($_POST['getData']))
//{
    include 'connect.php';
    //$start = $_POST['start'];
    $start = 0;
    //$limit = $_POST['limit'];
    $limit = 5;
    
    $sql = $conn->prepare("SELECT * FROM users WHERE user_uid = ?");
    $sql->execute([$_SESSION['user_uid']]);
    //$sql->execute(['jsmith123']);
    $userResult = $sql->fetch(PDO::FETCH_ASSOC);
    
    $stmOccupations = $conn->prepare('SELECT * from user_occupations WHERE user_id = ?');
    $stmOccupations->execute([$userResult['user_id']]);
    $userOccupation = $stmOccupations->fetch(PDO::FETCH_ASSOC);
    
    $stmJobs = $conn->prepare('SELECT * FROM jobs');
    $stmJobs->execute();
    if ($stmJobs->rowCount() > 0)
    {
        $response = "";
        while($jobResult = $stmJobs->fetch(PDO::FETCH_ASSOC))
        {
            if(
                  ($jobResult['isMedical'] == 'true' && $userOccupation['medical'] == 'true') ||
                  ($jobResult['isIT'] == 'true' && $userOccupation['IT'] == 'true') ||
                  ($jobResult['isHealthcare'] == 'true' && $userOccupation['healthcare'] == 'true') ||
                  ($jobResult['isBusiness'] == 'true' && $userOccupation['business'] == 'true') ||
                  ($jobResult['isFoodservice'] == 'true' && $userOccupation['foodservice'] == 'true') ||
                  ($jobResult['isHospitality'] == 'true' && $userOccupation['hospitality'] == 'true') ||
                  ($jobResult['isCulinary'] == 'true' && $userOccupation['culinary'] == 'true')
                  )
            {   
                      $response .= "<div id='job" . $jobResult['job_id'] . "' class='event my-4'>
                      <h3>". $jobResult['job_title'] ."</h3>
                      <p>". $jobResult['job_position'] ."</p>
                      <p>". $jobResult['job_description'] ."</p>
                      <p>Location: ". $jobResult['job_location'] ."</p>
                      <form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobResult['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form>
                      </div><hr>";
            }    
        }
        exit($response);
    }else{
        exit('reachedMax');
    }

    /*$jobListRecArray = array();
    foreach(getJobList($conn) as $e)
    {
        if(
              ($e->getMed() == 'true' && $userOccupation['medical'] == 'true') ||
              ($e->getIT() == 'true' && $userOccupation['IT'] == 'true') ||
              ($e->getHealth() == 'true' && $userOccupation['healthcare'] == 'true') ||
              ($e->getBus() == 'true' && $userOccupation['business'] == 'true') ||
              ($e->getFood() == 'true' && $userOccupation['foodservice'] == 'true') ||
              ($e->getHosp() == 'true' && $userOccupation['hospitality'] == 'true') ||
              ($e->getCul() == 'true' && $userOccupation['culinary'] == 'true')
              )
        {
            $jobListRecArray[] = new Job($e->getID(), $e->getEmployerID(), $e->getTitle(), $e->getDesc(), $e->getPos(), $e->getLoc(), $e->getMed(), $e->getIT(), $e->getHealth(), $e->getBus(), $e->getFood(), $e->getHosp(), $e->getCul(), $e->getDate());
        }    
    }*/

    //$jobRecList = getJobRecList($conn, $_SESSION['user_uid']);
    //$check = sizeof($jobRecList) % 2;

    //$sql = $conn->prepare("SELECT * FROM jobs WHERE user_uid=?");
    //$sql->execute([$_SESSION['user_uid']]);
    //$result = $sql->fetch(PDO::FETCH_ASSOC);
    
    
    //if(0 < sizeof($jobRecList))      
    //{ 
    /*
        if($check == 0)
        {
            if($limit <= sizeof($jobRecList))
            {
                for($i = 0; $i < $limit; $i++)
                {
                  $response .= "<div id='job" . $jobRecList[$i]->getID() . "' class='event my-4'>
                  <h3>". $jobRecList[$i]->getTitle() ."</h3>
                  <p>". $jobRecList[$i]->getPos() ."</p>
                  <p>". $jobRecList[$i]->getDesc() ."</p>
                  <p>Location: ". $jobRecList[$i]->getLoc() ."</p>
                  <form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobRecList[$i]->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>
                  </div><hr>";
                }
            }
            else
            {
                foreach($jobRecList as $j)
                {
                  $response .= "<div id='job" . $j->getID() . "' class='event my-4'>
                  <h3>". $j->getTitle() ."</h3>
                  <p>". $j->getPos() ."</p>
                  <p>". $j->getDesc() ."</p>
                  <p>Location: ". $j->getLoc() ."</p>
                  <form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>
                  </div><hr>";
                }
                //echo("<div>There are no more recommendations12</div>");
            }
        }
        else 
        {
            if($limit - 1 <= sizeof($jobRecList))
            {
                for($i = 0; $i < $limit - 1; $i++)
                {
                  $response .= "<div id='job" . $jobRecList[$i]->getID() . "' class='event my-4'>
                  <h3>". $jobRecList[$i]->getTitle() ."</h3>
                  <p>". $jobRecList[$i]->getPos() ."</p>
                  <p>". $jobRecList[$i]->getDesc() ."</p>
                  <p>Location: ". $jobRecList[$i]->getLoc() ."</p>
                  <form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobRecList[$i]->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>
                  </div><hr>";
                }
            }
            else
            {
                foreach($jobRecList as $j)
                {
                  $response .= "<div id='job" . $j->getID() . "' class='event my-4'>
                  <h3>". $j->getTitle() ."</h3>
                  <p>". $j->getPos() ."</p>
                  <p>". $j->getDesc() ."</p>
                  <p>Location: ". $j->getLoc() ."</p>
                  <form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form>
                  </div><hr>";
                }
                //echo("<div>There are no more recommendations23</div>");
            }
        }
        exit($response);
     * 
     */
    //}
    //else
    //{
    //    echo("<div class='my-4'><h3>We dont have any recommendations right now.</h3></div>");
    //    exit('reachedMax');
    //}
//}