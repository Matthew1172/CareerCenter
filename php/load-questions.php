<?php
session_start();
if(isset($_POST['submit']))
{
        include 'connect.php';
        $recovery_email = $_POST['recovery_email'];
        $errorEmail = false;
        $errorEmailEmpty = false;
        $errorEmailFound = false;

            if(filter_var($recovery_email, FILTER_VALIDATE_EMAIL))
            {
                $sql = $conn->prepare("SELECT * FROM users WHERE user_email=?");
                $sql->execute([$recovery_email]);
                if($sql->rowCount() > 0)
                {
                    echo("
                    <script>
                      $(document).ready(function() {
                          $('#question-form').submit(function(event){
                              event.preventDefault();
                              var a1 = $('#recovery-a1').val();
                              var a2 = $('#recovery-a2').val();
                              var a3 = $('#recovery-a3').val();
                              var recovery_email = '". $recovery_email ."';
                              var submit = '1';
                                  $.ajax(
                                      {
                                          url: 'php/check-answers.php',
                                          method: 'POST',
                                          data: {
                                              a1: a1,
                                              a2: a2,
                                              a3: a3,
                                              recovery_email: recovery_email,
                                              submit: submit
                                          },
                                          success: function(response){
                                              if(response == 'error100')
                                              {
                                                  window.location.assign('recovery-fail.php')
                                              }
                                              else if(response == 'error200')
                                              {
                                                  window.location.assign('recovery-fail.php')
                                              }
                                              else if(response == 'success')
                                              {
                                                  window.location.assign('home.php')
                                              }
                                              else
                                              {
                                                  window.location.assign('index.php')
                                              }
                                          },
                                          dataType: 'text'
                                      }
                                  );
                          });
                      });
                    </script>
                    ");
                    while($result = $sql->fetch(PDO::FETCH_ASSOC))
                    {
                        echo('<div>');
                        echo('<form id="question-form" action="php/check-answers.php" method="POST">');
                        echo('<ul>');
                        echo('<li><p class="question-line">'. $result['user_q1'] .'?</p>');
                        echo('<input id="recovery-a1" type="text" placeholder="Security answer 1" class="form-control" aria-label="small"/></li>');
                        echo('<li><p class="question-line">'. $result['user_q2'] .'?</p>');
                        echo('<input id="recovery-a2" type="text" placeholder="Security answer 2" class="form-control" aria-label="small"/></li>');
                        echo('<li><p class="question-line">'. $result['user_q3'] .'?</p>');
                        echo('<input id="recovery-a3" type="text" placeholder="Security answer 3" class="form-control" aria-label="small"/></li>');
                        echo('<li><button id="question-submit" class="btn btn-outline-primary" type="submit">Submit answers</button></li>');
                        echo('</ul>');
                        echo('</form>');
                        echo('</div>');
                    }
                }
                else
                {
                        $errorEmailFound = true;
                }
            }
            else
            {
                $errorEmail = true;
            }
}
else
{
    header("Location: ../index.php");
}
?>
<script>
    $("#recovery-email").removeClass("input-error")
    var errorEmail = "<?php echo $errorEmail; ?>";
    var errorEmailFound = "<?php echo $errorEmailFound; ?>";

    if(errorEmail == true)
    {
        $("#recovery-email").addClass("input-error")
        confirm('Please put a valid email');
    }
    if(errorEmailFound == true)
    {
        $("#recovery-email").addClass("input-error")
        confirm('Sorry, this email does not exist.');
    }
    if(errorEmail == false && errorEmailFound == false)
    {
        $("#recovery-email").val("")
        $(".question").show();
    }
</script>
