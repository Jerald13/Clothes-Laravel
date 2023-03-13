
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    {{-- {{ asset('{{ asset('css/feather.css') }}') }} --}}
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme">
  </head>
  <body class="vertical  dark  ">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="{{ 'fe-menu navbar-toggler-icon' }}"></i>
        </button>
        <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
              <i class="{{ 'fe-sun fe-16' }}"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="{{ 'fe-grid fe-16' }}"></span>
            </a>
          </li>
          <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="{{ 'fe-bell fe-16' }}"></span>
              <span class="dot dot-md bg-success"></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="{{ asset('assets/avatars/face-1.jpg') }}" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
              <a class="dropdown-item" href="#">Activities</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="{{ 'fe-x' }}"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="{{ 'fe-home fe-16' }}"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="index"><span class="ml-1 item-text">Default</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-analytics.html"><span class="ml-1 item-text">Analytics</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-sales.html"><span class="ml-1 item-text">E-commerce</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-saas.html"><span class="ml-1 item-text">Saas Dashboard</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./dashboard-system.html"><span class="ml-1 item-text">Systems</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Product Site</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#Product" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe-box fe-16"></i>
                <span class="ml-3 item-text">Products</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="Product">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="productDisplay"><span class="ml-1 item-text">Display Product</span>
                  </a>
                  <a class="nav-link pl-3" href="productCreate"><span class="ml-1 item-text">Add Product</span>
                  </a>
                </li>
              </ul>
            </li>

            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Product Category Site</span>
              </p>
              <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item dropdown">
                  <a href="#Category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fe-box fe-16"></i>
                    <span class="ml-3 item-text">Category</span>
                  </a>
                  <ul class="collapse list-unstyled pl-4 w-100" id="Category">
                    <li class="nav-item">
                      <a class="nav-link pl-3" href="{{ route('categories.index') }}"><span class="ml-1 item-text">Display Category</span>
                      </a>
                      <a class="nav-link pl-3" href="{{ route('categories.create') }}"><span class="ml-1 item-text">Add Category</span>
                      </a>
                    </li>
                  </ul>
                </li>

                
                <p class="text-muted nav-heading mt-4 mb-1">
                  <span>Product Tags site</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                  <li class="nav-item dropdown">
                    <a href="#Tags" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                      <i class="fe-box fe-16"></i>
                      <span class="ml-3 item-text">Tags</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="Tags">
                      <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('tags.index') }}"><span class="ml-1 item-text">Display Tags</span>
                        </a>
                        <a class="nav-link pl-3" href="{{ route('tags.create') }}"><span class="ml-1 item-text">Add Tags</span>
                        </a>
                      </li>
                    </ul>
                  </li>


                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Payment Site</span>
                  </p>
                  <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item dropdown">
                      <a href="#Payment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe-box fe-16"></i>
                        <span class="ml-3 item-text">Payment</span>
                      </a>
                      <ul class="collapse list-unstyled pl-4 w-100" id="Payment">
                        <li class="nav-item">
                          <a class="nav-link pl-3" href="productDisplay"><span class="ml-1 item-text">Display Payment</span>
                          </a>
                          <a class="nav-link pl-3" href="productCreate"><span class="ml-1 item-text">Add Payment</span>
                          </a>
                        </li>
                      </ul>
                    </li>


                    <p class="text-muted nav-heading mt-4 mb-1">
                      <span>Report Site</span>
                    </p>
                    <ul class="navbar-nav flex-fill w-100 mb-2">
                      <li class="nav-item dropdown">
                        <a href="#Report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                          <i class="fe-box fe-16"></i>
                          <span class="ml-3 item-text">Report</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="Report">
                          <li class="nav-item">
                            <a class="nav-link pl-3" href="productDisplay"><span class="ml-1 item-text">Display Report</span>
                            </a>
                          </li>
                        </ul>
                      </li>


                    <p class="text-muted nav-heading mt-4 mb-1">
                        <span>Order Site</span>
                      </p>
                      <ul class="navbar-nav flex-fill w-100 mb-2">
                        <li class="nav-item dropdown">
                          <a href="#Order" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="fe-box fe-16"></i>
                            <span class="ml-3 item-text">Order</span>
                          </a>
                          <ul class="collapse list-unstyled pl-4 w-100" id="Order">
                            <li class="nav-item">
                              <a class="nav-link pl-3" href="productDisplay"><span class="ml-1 item-text">Display Order</span>
                              </a>
                              <a class="nav-link pl-3" href="productCreate"><span class="ml-1 item-text">Add Order</span>
                              </a>
                            </li>
                          </ul>
                        </li>


                        
                        <p class="text-muted nav-heading mt-4 mb-1">
                          <span>User Site</span>
                        </p>
                        <ul class="navbar-nav flex-fill w-100 mb-2">
                          <li class="nav-item dropdown">
                            <a href="#User" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                              <i class="fe-box fe-16"></i>
                              <span class="ml-3 item-text">User</span>
                            </a>
                            <ul class="collapse list-unstyled pl-4 w-100" id="User">
                              <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.display') }}"><span class="ml-1 item-text">Display User</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.displayBannedUser') }}"><span class="ml-1 item-text">Display Banned User</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.display.xsl') }}"><span class="ml-1 item-text">Display User In XSL</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('users.display.xml') }}"><span class="ml-1 item-text">Display User In XML</span>
                                </a>
                              </li>
                            </ul>
                          </li>

                        <p class="text-muted nav-heading mt-4 mb-1">
                          <span>Role Site</span>
                        </p>
                        <ul class="navbar-nav flex-fill w-100 mb-2">
                          <li class="nav-item dropdown">
                            <a href="#Role" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                              <i class="fe-box fe-16"></i>
                              <span class="ml-3 item-text">Role</span>
                            </a>
                            <ul class="collapse list-unstyled pl-4 w-100" id="Role">
                              <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('role.displayRole') }}"><span class="ml-1 item-text">Display Role</span>
                                </a>
                                <a class="nav-link pl-3" href="productCreate"><span class="ml-1 item-text">Add Editor (Admin)</span>
                                </a>
                              </li>
                            </ul>
                          </li>



                        

     
          <div class="btn-box w-100 mt-4 mb-1">
            <a href="https://themeforest.net/item/tinydash-bootstrap-html-admin-dashboard-template/27511269" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
              <i class=""></i><span class="small">Buy now</span>
            </a>
          </div>
        </nav>
      </aside>
      


</body>
</html>



      
    