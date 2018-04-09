<?php
    $approvedCompanies = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) as total FROM companies WHERE active = 1"));
    $notApprovedCompanies = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(id) as total FROM companies WHERE active = 0"));

    echo "<br />";
    echo "<br />";
    echo "<h1>Welcome back <b>$_SESSION[user] </b>!</h1>";
    echo "<br/>";
    echo "<br/>";
    echo "<h3>There's a total of $approvedCompanies[total] companies</h3>";
    echo "<h3>Companies awaiting for the approval: $notApprovedCompanies[total]</h3>";
?>
