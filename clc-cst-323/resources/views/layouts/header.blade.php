<!-- This page contains some partial php tags because bootstrap and laravel blade tags were not getting along with each other -->

<!-- This is the form for going to the user profile put outside of the navbar so that it doesn't interfer with the 
rest of the navbar -->
<form action="userProfile" id="userProfile" style="margin:0px;" method="get"></form>
<input form="userProfile" type="hidden" name="_token" value="{{csrf_token()}}">
<input form="userProfile" type="hidden" name="ID" value="{{Session('ID')}}">
<form action="groups" id="groups" style="margin:0px;" method="get"></form>
<input form="groups" type="hidden" name="_token" value="{{csrf_token()}}">
<input form="groups" type="hidden" name="ID" value="{{Session('ID')}}">
<!-- Bootstrap navbar that will be included at the top of all pages for the purpose of navigation -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgb(60, 63, 65); margin-bottom:20px;">
  <a class="navbar-brand" href="https://clc-cst-323.azurewebsites.net/clc-cst-323/">CLC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- If the user is logged in a link with they're name to take them to their profile is included here -->
      <?php if(Session::has('USERNAME')){?>
      <li class="nav-item">
    <a class="nav-link" href="Products">Products</a>
  </li>
      <!-- If the currently logged in user is an admin then the admin menu is linked after the user profile -->
      <?php if(session('ROLE')){?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <!-- Link to take the user to the user admin page -->
          <a class="dropdown-item" href="userAdmin">User Admin</a>
          <a class="dropdown-item" href="ProductAdmin">Product Admin</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="createProduct">New Product</a>
        </div>
      </li>
      <?php }?>
      <!-- Link to let the user sign out if they're currently logged in -->
      <li class="nav-item">
      	<a class="nav-link" href="SignOut">Sign Out</a>
      </li>
      <?php } else {?>
      <!-- Link to let the user login if they are not currently logged in -->
      <li class="nav-item">
        <a class="nav-link" href="Login">Login</a>
      </li>
      <?php }?>
    </ul>
   
  </div>
</nav>
