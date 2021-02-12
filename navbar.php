
 <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-film mr-2"></i>
               My Blog
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
               <!--  <li class="nav-item">
                    <a class="nav-link nav-link-1 active" aria-current="page" href="index.html">Photos</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="index.php">Home</a>
                </li>
               
                
              
              <?php if(check()): ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="welcome.php">Dashbord</a>
                </li>
                    <li class="nav-item">
                    <a class="nav-link nav-link-4" href="logout.php">logout</a>
                </li>
            <?php endif; ?> 

            <?php if(!check()): ?>

                        <li class="nav-item">
                    <a class="nav-link nav-link-4" href="login.php">login</a>
                </li>

                <?php endif; ?>

                
            </ul>
            </div>
        </div>
    </nav>