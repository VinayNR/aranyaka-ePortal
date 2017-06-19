<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: sLogin.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM faculty WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Student Portal</title>
        <link href='css/bootstrap.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="eportalhome.css">
	</head>
	<body>
        <div class='row'>
            <div class='col-xs-12'>
                <div class="style"> 
                    <div class='navbar navbar-inverse navbar-static-top'>
                        <h1><i class='glyphicon glyphicon-book'></i>E-PORTAL
                            <button type='button' class='navbar-toggle'
                                data-toggle='collapse'
                                data-target='.navbar-collapse'>
                            <span class='sr-only'>Toggle navigation</span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            </button>
                            <ul class='nav nav-tabs navbar-right collapse navbar-collapse'>
                                <a data-toggle='dropdown'><font color='black'><font size='3px'><span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></font></font>
                                <ul class="dropdown-menu">
                                    <li><a href="logout.php?logout"><font color='black'><font size='3px'><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</font></font></a>
                                    </ul></a>
                            </ul>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="container">
                <div class='style1'></div>
                    <div class="background-image" ></div>
                        <div class="content">
                            <div class="text-center">
                                <i class='glyphicon glyphicon-education'></i>
                                <h2><strong>Welcome to this side of the Portal</strong></h2>
                                <hr>
		                        <p>
		                        </p><div class="divider-10"></div>  
                                 <div>    
                                <?php
                                            $sql = "SELECT * FROM tbl_country ORDER BY country_name";
                                            try {
                                                $stmt = $DB->prepare($sql);
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                            } catch (Exception $ex) {
                                                echo($ex->getMessage());
                                            }
                                            ?>
                                        <label>Country:
                                                <select name="country" onChange="showState(this);">
                                                    <option value="">Please Select</option>
                                                    <?php foreach ($results as $rs) { ?>
                                                        <option value="<?php echo $rs["id"]; ?>"><?php echo $rs["country_name"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                        </label>
                                   </div> 
                                <div class="divider-10"></div>                   
    
                                        <div id="output1"></div>
                               
                                <div class="divider-10"></div> 
                                
                                    <button type="submit" class="btn btn-md btn-primary slide" name="btn-viewmat">View Materials</button>
                                    <div class="divider-10"></div> 
                                    
                                    <hr>
                                    <p>If you don't know which course belongs to which semester, then<a href="infotable.html" class="btn btn-md btn-info" role="button">Click Here</a></p>
                            </div>
                        </div>
                
                        <div class='style1'>
                        </div>
                </div>
            
        </div>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <script src="jquery-1.9.0.min.js"></script>
        <script>
                    function showState(sel) {
                        var country_id = sel.options[sel.selectedIndex].value;
                        $("#output1").html("");
                        
                        if (country_id.length > 0) {

                            $.ajax({
                                type: "POST",
                                url: "fetch_state.php",
                                data: "country_id=" + country_id,
                                cache: false,
                                beforeSend: function() {
                                    $('#output1').html('<img src="loader.gif" alt="" width="24" height="24">');
                                },
                                success: function(html) {
                                    $("#output1").html(html);
                                }
                            });
                        }
                    }

                 
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        

        <script src='js/bootstrap.js'></script>
        
		
</body>
</html>
<?php ob_end_flush(); ?>
		
	