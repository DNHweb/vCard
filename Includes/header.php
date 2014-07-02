<?php require_once ("Includes/session.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>My Site's Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
        <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/index.php"><?php echo configuration_get_value('site_name') ?></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                            $statement = $databaseConnection->prepare("SELECT id, menulabel FROM pages");
                            $statement->execute();
                            
                            if($statement->error)
                            {
                                die("Database query failed: " . $statement->error);
                            }
                            
                            $statement->bind_result($id, $menulabel);
                            while ($statement->fetch())
                            {
                                echo "<li><a href=\"/page.php?pageid=$id\">$menulabel</a></li>\n";
                            }
                        ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if (logged_on())
                            {
                                echo '<li><a href="/logoff.php">Sign out</a></li>' . "\n";
                                if (is_admin())
                                {
                                    echo '<li><a href="/addpage.php">Add</a></li>' . "\n";
                                    echo '<li><a href="/selectpagetoedit.php">Edit</a></li>' . "\n";
                                    echo '<li><a href="/deletepage.php">Delete</a></li>' . "\n";
                                }
                            }
                            else
                            {
                                echo '<li><a href="/logon.php">Login</a></li>' . "\n";
                                echo '<li><a href="/register.php">Register</a></li>' . "\n";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">