<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!--        <link href="css/menu.css" rel="stylesheet" type="text/css"/>-->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Team Sequel</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="main.php">
                      <i class="fa fa-home"></i>
                      Home
                      <span class="sr-only">(current)</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="agents.php">
                      <i class="fa fa-users"></i>
                      Agents
                      <span class="sr-only">(current)</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="grants.php">
                    <i class="fa fa-usd"></i>
                    Grants
                    <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="statistics.php">
                    <i class="fa fa-bar-chart"></i>
                    Statistics
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-cog"></i>
                    Settings
                </a>
                  <!-- Agent Dropdown-->
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    
                    <a class="dropdown-item" href="agent_remove_house.php">
                      <i class="fa fa-minus"></i>
                      Remove House
                  </a>
                    <a class="dropdown-item" href="agent_update_house.php">
                      <i class="fa fa-pencil"></i>
                      Update House
                  </a>
                    <a class="dropdown-item" href="settings.php">
                      <i class="fa fa-user"></i>
                      Update Profile
                  </a>
                    
                </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="logout.php">
                    <i class="fa fa-sign-out"></i>
                    Logout
                </a>
              </li>
            </ul>
          </div>
        </nav>

<!--        <div>
            <ul>
                 Home 
                <li>
                    <a href="main.php">
                        <div class="icon">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Home">Home</span></div>
                    </a>
                </li>
                 Housing Grants 
                <li>
                    <a href="grants.php">
                        <div class="icon">
                            <i class="fa fa-usd" aria-hidden="true"></i>
                            <i class="fa fa-usd" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Housing Grants">Housing Grants</span></div>
                    </a>
                </li>
                 Agents 
                <li>
                    <a href="agents.php">
                        <div class="icon">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Agents">Agents</span></div>
                    </a>
                </li>
                 Housing Popularity  
                <li>
                    <a href="housepop.php">
                        <div class="icon">
                            <i class="fa fa-fire" aria-hidden="true"></i>
                            <i class="fa fa-fire" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Housing Popularity">Housing Popularity</span></div>
                    </a>
                </li>
                 Wishlist 
                <li>
                    <a href="wishlist.php">
                        <div class="icon">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Wishlist">Wishlist</span></div>
                    </a>
                </li>
                 Settings 
                <li>
                    <a href="settings.php">
                        <div class="icon">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Settings">Settings</span></div>
                    </a>
                </li>
                 Logout 
                <li>
                    <a href="logout.php">
                        <div class="icon">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </div>
                        <div class="name"><span data-text="Logout">Logout</span></div>
                    </a>
                </li>

            </ul>
        </div>-->

        

    </body>
    
</html>

