<?php 
session_start();
if(isset($_SESSION["users"])){
    header("location: login.php");
}
$username = $_SESSION["user_name"];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Website</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
 
<div class="main">
  <div class="navbar">     
         <ul class="nav links">
                <li><a href="index.php">About</a> </li>
                <li><a href="skills.html">Skills</a> </li>
                <li><a href="Certificate.html">Cetificate</a> </li>
                <li><a href="Contact Info.html">Contact Info</a> </li>
                <li class="user" ><strong style=" margin-right: 30px; color:#008b8b;">Welcome back, <?php echo $username; ?>!</strong></li>
                <a href="index.php">
                <img id="logo"  src="AGanda.png" alt="AG">
</div>



            
  </a>
  </ul>
  </div>
</div>


  <div>
  <div class="details">

                <h1>WELCOME, I'm Allyssa Gallo</h1>
                <h3>Information Technology Student</h3>
                <p>This is my personal website for my creatives and portfolio</p>
                <p>"Work smart, play hard to explore beyond your limit"</p>
  </div>
</div>

<div class="gallery-container">
<div class="gallery">
    <img src="photo2.PNG" alt="Cinque Terre" width="600" height="400">
  </a>
  <div class="desc">Image Gallery 1</div>
</div>

<div class="gallery">
    <img src="sky.JPG" alt="Forest" width="600" height="400">
  </a>
  <div class="desc">Image Gallery 2</div>
</div>

<div class="gallery">
    <img src="pic.JPG" alt="Northern Lights" width="600" height="400">
  </a>
  <div class="desc">Image Gallery 3</div>
</div>
</div>
   


        <!---ABOUT SECTION OF THE PERSONAL WEBSITE-->

<section class="about">

 <div class="main1"></div>
  <div class="container">
                <img src="professional.JPG" alt="Professional Photo" style="float: left; margin-right: 20px;">
                <div class="text">
                    <h2 id="About">About Me</h2>
                    <h5>Developer & Designer</h5>
                    
                    <p>I am a 20-year-old Information Technology Student at National University who has talent for communication skills, management skills, and planning skills. I had experience joining an academic organization in college under the role of a social media manager wherein we unleashed our creativity in creating pubmats for events and announcements. This built my skills in communication, creativity, and the ability to work with deadlines and under pressure.</p>
                   <h5>Experiences </h5>
                   <p> I am a former social media manager for an academic organization in college and have experience creating visual posters for events and announcements and social media management. I hope to work with you in the future! 
                    I personally do video editing for my reels and personal youtube channel.
                   </p>
    
                   <h5>hobbies </h5>
                   <p>Get to know me a little bit by knowing my hobbies that you might relate into!</p>
                   <p> - Listening to music </p>
                   <p> - Video recording for vlog </p>
                   <p> - Volleyball</p>
                   <p> - DIY painting</p>
                   <p> - Mobile Games</p>





  </div>      
 </div>
</section>


    <!---COMMENT SECTION -->

    
    <div>
    <div class="container_comment">
        <div class="col-md-8">
            <h1 id="comments" class="text-center">Leave a Comment</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="comment" id="ycomment" class="form-label">Your Comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="5" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn_submit">Submit</button>
                <button type="button" onclick="window.location.href='logout.php'; alert('You are logging out of your account!')">Logout</button>
            </form>
        </div>
    </div>

  <?php
     if(isset($_POST["submit"])){
     $message = $_POST["comment"];
     $date = date("Y-m-d");

       // Get the user's ID from the session
      if(isset($_SESSION["user"])) {
                            $users = $_SESSION["user_id"];
                        } else {
                            // Handle the case where user ID is not set in session
                            die("User ID not found in session");
                        }

                        require_once("database.php");

                        $sql = "INSERT INTO comments (ID, Date, Comment) VALUES (?, ?, ?)";

                        $stmt = mysqli_stmt_init($conn);

                        $preparestmt = mysqli_stmt_prepare($stmt, $sql);

                        if ($preparestmt) {
                            mysqli_stmt_bind_param($stmt, "sss", $users, $date, $message);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>Comment sent successfully!</div>";
                        } else {
                            die("Something went wrong");
                        }
                    }
                ?>



            
  </div>
</div>
</div>

<div>

</div>

</head>
</body>
</html>


</div>

<div>

</div>

</head>
</body>
</html>


