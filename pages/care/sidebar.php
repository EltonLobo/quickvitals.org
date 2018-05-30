            <?php
			   $_SESSION['ward'] = $userRow[ward];
			?>
			<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="home.php"><i class="fa fa-home"></i> Home</a>
                  </li>
                  <li><a href="list.php"><i class="fa fa-folder-open"></i> <?php echo $userRow[ward]; ?></a>
                  </li>
				  <li><a href="medication.php"><i class="fa fa-plus"></i> Medication</a>
                  </li>
                </ul>
              </div>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Doctor" href="list-doctors.php">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Request Medication" href="request.php">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Support" href="help.php">
                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php?logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>