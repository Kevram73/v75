<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 97%;">
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">
				<li class="treeview">
				  <a href="{{route('admin.home')}}">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
					<span>Tableau de bord</span>
					<span class="pull-right-container">
					</span>
				  </a>

				</li>

				<li class="treeview">
				  <a href="#">
					<i data-feather="users"></i>
					<span>Gestion des clients</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li>
						<a href="{{route('admin.clients.index')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Liste des clients
							<span class="pull-right-container">
							</span>
						</a>
					</li>
					<li>
						<a href="{{route('admin.clients_disabled')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>liste des clients retirés
							<span class="pull-right-container">
							</span>
						</a>
					</li>

				  </ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i data-feather="pie-chart"></i>
					<span>Statistiques</span>
					<span class="pull-right-container">
					</span>
				  </a>
				</li>
				<li class="treeview">
				  <a href="#">
					<i data-feather="message-square"></i>
					<span>Gestion des annonces</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li>
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rédiger une annonce
                        </a>
                    </li>
					<li>
                        <a href="#">
                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Liste des annonces
                        </a>
                    </li>
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i data-feather="alert-octagon"></i>
					<span>Messages clients</span>
					<span class="pull-right-container">
					</span>
				  </a>
				</li>
				<li class="treeview">
				  <a href="#">
					<i data-feather="lock"></i>
					<span>Gestion des admins</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Créer un admin
							<span class="pull-right-container">
							</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>liste des admins
							<span class="pull-right-container">
							</span>
						</a>
					</li>
				  </ul>
				</li>
			  </ul>

			  <div class="sidebar-widgets">
				  <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
					<div class="text-center">
						<img src="../../../images/svg-icon/color-svg/custom-32.svg" class="sideimg p-5" alt="">
						<h4 class="title-bx text-primary"><br>V75 Espace Admin</h4>
					</div>
				  </div>
			  </div>
		  </div>
		</div>
    </section>
  </aside>
