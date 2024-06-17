<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 97%;">
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">
				<li>
				  <a href="{{route('client.dashboard')}}">
                    <i data-feather="pie-chart"></i>
                    <span>Tableau de bord</span>
					<span class="pull-right-container">
					</span>
				  </a>

				</li>

                <li>
                    <a href="">
                      <i data-feather="user-check"></i>
                      <span>Mon compte</span>
                      <span class="pull-right-container">
                      </span>
                    </a>
                </li>

				<li class="treeview">
				  <a href="#">
					<i data-feather="minus-circle"></i>
					<span>Mes transactions</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li>
						<a href="">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mes invests
							<span class="pull-right-container">
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mes retraits
							<span class="pull-right-container">
							</span>
						</a>
					</li>

				  </ul>
				</li>

                <li>
                    <a href="">
                      <i data-feather="message-circle"></i>
                      <span>Actualités</span>
                      <span class="pull-right-container">
                      </span>
                    </a>
                </li>

				<li>
				  <a href="">
					<i data-feather="alert-octagon"></i>
					<span>Service client</span>
					<span class="pull-right-container">
					</span>
				  </a>
				</li>
				<li>
				  <a href="#">
					<i data-feather="home"></i>
					<span>Retour à l'accueil</span>
					<span class="pull-right-container">
					</span>
				  </a>
                </li>

			  </ul>

			  <div class="sidebar-widgets">
				  <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
					<div class="text-center">
						<img src="{{asset('/images/OIPb.jpeg')}}" class="sideimg p-9" alt="">
						<h4 class="title-bx text-primary"><br>V75 Espace Client</h4>
					</div>
				  </div>
			  </div>
		  </div>
		</div>
    </section>
  </aside>
