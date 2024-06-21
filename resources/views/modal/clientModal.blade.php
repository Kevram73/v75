<!-- quick_user_toggle -->
<div class="modal modal-right fade" id="quick_user_toggle" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content slim-scroll3">
        <div class="modal-body p-30 bg-white">
          <div class="d-flex align-items-center justify-content-between pb-30">
              <h4 class="m-0">Profil utilisateur
              <small class="text-fade fs-12 ms-5">Compte client</small></h4>
              <a href="#" class="btn btn-icon btn-primary-light btn-sm no-shadow" data-bs-dismiss="modal">
                  <span class="fa fa-close"></span>
              </a>
          </div>
          <div>
              <div class="d-flex flex-row">
                  <div class=""><img src="{{asset('/images/ui.jpg')}}" alt="user" class="rounded bg-primary-light w-150" width="100"></div>
                  <div class="ps-20">
                      {{-- Illuminate\Support\Facades\Auth::guard('admin')->admin()->email --}}
                      {{-- {{ auth()->admin()->email }} --}}
                      <h5 class="mb-0">{{ Auth::guard('client')->user()->first_name }} {{ Auth::guard('client')->user()->last_name }}</h5>
                      <p class="my-5 text-fade">Client</p>
                      <a href="#"><span class="icon-Mail-notification me-5 text-danger"><span class="path1"></span><span class="path2"></span></span> {{ Auth::guard('client')->user()->email }}</a>
                      {{-- <button class="btn btn-primary-light btn-md mt-5"><i class="ti-plus"></i> Se déconnecter</button> --}}
                      <a href="{{ route('client.auth_logout') }}" class="btn btn-danger btn-md mt-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter <i class="fa fa-sign-out"></i></a>
                      <form id="logout-form" action="{{ route('client.auth_logout') }}" method="POST" style="display: none;">@csrf
                      </form>
                  </div>
              </div>
          </div>
            <div class="dropdown-divider my-30"></div>
            <div>
              <div class="d-flex align-items-center mb-30">
                  <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                        <span class="icon-Library fs-24"><span class="path1"></span><span class="path2"></span></span>
                  </div>
                  <div class="d-flex flex-column fw-500">
                      <a href="{{route('client.clientProfile')}}" class="text-dark hover-primary mb-1 fs-16">Mon compte</a>
                      <span class="text-fade">Informations personnelles</span>
                  </div>
              </div>
              <div class="d-flex align-items-center mb-30">
                  <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                      <span class="icon-Group-chat fs-24"><span class="path1"></span><span class="path2"></span></span>
                  </div>
                  <div class="d-flex flex-column fw-500">
                      <a href="" class="text-dark hover-primary mb-1 fs-16">Messages</a>
                      <span class="text-fade">Mes messages</span>
                  </div>
              </div>
              <div class="d-flex align-items-center mb-30">
                  <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                      <span class="icon-Write fs-24"><span class="path1"></span><span class="path2"></span></span>
                  </div>
                  <div class="d-flex flex-column fw-500">
                      <a href="l" class="text-dark hover-primary mb-1 fs-16">Mes transactions</a>
                      <span class="text-fade">historique des transactions</span>
                  </div>
              </div>

            </div>
            <div class="dropdown-divider my-30"></div>
            {{-- <div>
              <div class="media-list">
                  <a class="media media-single px-0" href="#">
                      <h4 class="w-50 text-gray fw-500">Dépôt</h4>
                      <div class="media-body ps-15 bs-5 rounded border-danger">
                        <p>montant : 100000 Fcfa <br>via : Flooz mobile money</p>
                        <span class="text-fade">11/06/2024 10:55</span>
                      </div>
                  </a>

                  <a class="media media-single px-0" href="#">
                    <h4 class="w-50 text-gray fw-500">Retrait</h4>
                    <div class="media-body ps-15 bs-5 rounded border-primary">
                      <p>montant : 6600 Fcfa <br>via : Perfect money</p>
                      <span class="text-fade">10/06/2024 16:00</span>
                    </div>
                  </a>

              </div>
            </div> --}}
        </div>
      </div>
    </div>
</div>
<!-- /quick_user_toggle -->

<!-- Control Sidebar -->
<aside class="control-sidebar">

  <div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger" data-toggle="control-sidebar"><i class="ion ion-close text-white" ></i></span> </div>  <!-- Create the tabs -->
  <ul class="nav nav-tabs control-sidebar-tabs">
    <li class="nav-item"><a href="#control-sidebar-home-tab" data-bs-toggle="tab" ><i class="mdi mdi-message-text"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
        <div class="flexbox">
          <p><center>Annonces</center></p>
        </div>

        <div class="media-list media-list-hover mt-20">
          <div class="media py-10 px-0">

          </div>
          <div class="media py-10 px-0">

          </div>
          <div class="media py-10 px-0">

          </div>
        </div>
    </div>
    <!-- /.tab-pane -->

  </div>
</aside>
<!-- /.control-sidebar -->
