<?php
    session_start();
?>
<div class="d-flex justify-content-center">
    <img src="../images/logo.png" alt="" class="logo">
</div>
<div class="sidebar_item d-flex flex-column justify-content-between text-center" id="sidebar_item">
    <div class="user link poppins-medium">
        <div style="margin: 0px;">
            Welcome, <?php echo $_SESSION['uname']; ?>
        </div>
        <div style="margin: 0px;">
            <a href="logout.php" class="link">Logout</a>
        </div>
    </div>
    <a href="result_portal.php" class="link poppins-medium">Result Portal</a> <br>
    <a href="add_student_form.php" class="link poppins-medium">Admission Portal</a> <br>
    <a href="new_dashboard.php" class="link poppins-medium">Home</a>
</div>