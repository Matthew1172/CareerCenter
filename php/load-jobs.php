<?php
session_start();

    include 'connect.php';
    $jobNewCount = $_POST['jobNewCount'];
    $jobList = getJobList($conn, $_SESSION['user_uid']);
    $check = sizeof($jobList) % 2;
      
    if(sizeof($jobList) == 0)      
    {              
        echo('<tr>');
        echo("<td>There are no more jobs</td>");  
        echo('</tr>'); 
    }
    else if($check == 0)
    {
        if($jobNewCount <= sizeof($jobList))
        {
            for($i = 0; $i < $jobNewCount; $i++)
            {
                echo('<tr>');
                echo('
                <td><p>'. $jobList[$i]->getPos()     .'</p></td>
                <td><p>'. $jobList[$i]->getTitle()        .'</p></td>
                <td><p>'. $jobList[$i]->getLoc()     .'</p></td>
                ');
                if(isset($_SESSION['user_uid']))
                {
                    echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobList[$i]->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
                }
                else
                {
                    echo('<td><p>Login to view this job</p></td>');
                }
                echo('</tr>');
            }   
        }
        else
        {
            foreach($jobList as $j)
            {
                echo('<tr>');
                echo('
                <td><p>'. $j->getPos()     .'</p></td>
                <td><p>'. $j->getTitle()        .'</p></td>
                <td><p>'. $j->getLoc()     .'</p></td>
                ');
                if(isset($_SESSION['user_uid']))
                {
                    echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
                }
                else
                {
                    echo('<td><p>Login to view this job</p></td>');
                }
                echo('</tr>');  
            }   
            echo('<tr>');
            echo("<td>There are no more jobs</td>");  
            echo('</tr>'); 
        }
    }
    else
    {
        if($jobNewCount - 1 <= sizeof($jobList))
        {
            for($i = 0; $i < $jobNewCount - 1; $i++)
            {
                echo('<tr>');
                echo('
                <td><p>'. $jobList[$i]->getPos()     .'</p></td>
                <td><p>'. $jobList[$i]->getTitle()        .'</p></td>
                <td><p>'. $jobList[$i]->getLoc()     .'</p></td>
                ');
                if(isset($_SESSION['user_uid']))
                {
                    echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobList[$i]->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
                }
                else
                {
                    echo('<td><p>Login to view this job</p></td>');
                }
                echo('</tr>');
            }
        }
        else
        {
           foreach($jobList as $j)
           {
                echo('<tr>');
                echo('
                <td><p>'. $j->getPos()     .'</p></td>
                <td><p>'. $j->getTitle()        .'</p></td>
                <td><p>'. $j->getLoc()     .'</p></td>
                ');
                if(isset($_SESSION['user_uid']))
                {
                    echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $j->getID() . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
                }
                else
                {
                    echo('<td><p>Login to view this job</p></td>');
                }
                echo('</tr>');  
            }   
            echo('<tr>');
            echo("<td>There are no more jobs</td>");  
            echo('</tr>');  
        }
    }
    
    
    
    
    
    /*
    $sql = $conn->prepare('SELECT * FROM jobs ORDER BY dateStamp DESC LIMIT ' . $jobNewCount . ';');
    $sql->execute();
    while($jobResult = $sql->fetch(PDO::FETCH_ASSOC))
    {
        echo('<tr>');
        echo('
        <td><p>'. $jobResult['job_position']     .'</p></td>
        <td><p>'. $jobResult['job_title']        .'</p></td>
        <td><p>'. $jobResult['job_location']     .'</p></td>
        ');
        if(isset($_SESSION['user_uid']))
        {
            echo("<td><form action='job-page.php' method='GET'><button name='job-btn-value' value='" . $jobResult['job_id'] . "' class='btn btn-primary job-btn' type='submit'>View</button></form></td>");
        }
        else
        {
            echo('<td><p>Login to view this job</p></td>');
        }
        echo('</tr>');
    }
*/
?>
