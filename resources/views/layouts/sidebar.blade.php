<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tint" style="color:red"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Blood Bank</div>
        </a>
  
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
  
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
  
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          Interface
        </div>
  
        <!-- Nav Item - Pages Collapse Menu -->
        @role('admin')
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Configs</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              
              <h6 class="collapse-header">Application configs:</h6>
            <a class="collapse-item" href="{{route("governorate.index")}}">Governorates</a>
            <a class="collapse-item" href="{{route('city.index')}}">Cities</a>
            <a class="collapse-item" href="{{route('config.edit',['id'=>1])}}">Settings</a>
            <a class="collapse-item" href="{{route('role.index')}}">Roles And Perrmission</a>
            </div>
          </div>
        </li>
        @endrole
          <!-- Nav Item - Posts -->
          <li class="nav-item">
          <a class="nav-link" href="{{route('post.index')}}">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Posts</span></a>
          </li>
  
        <!-- Divider -->
        <hr class="sidebar-divider">
        
        @role('admin')
        <!-- Heading -->
        <div class="sidebar-heading">
  
         Users And       
           Clients
           
        </div>
          
  
  
          <!-- Nav Item - Clients -->
          <li class="nav-item">
            <a class="nav-link" href="charts.html">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Clients</span></a>
          </li>
  
          
          <!-- Nav Item - Users -->
          
   

          <li class="nav-item">
          <a class="nav-link" href="{{route('user.index')}}">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Users</span></a>
          </li>
          @endrole
        
     
  
        
  
  
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
  
      </ul>
      <!-- End of Sidebar -->

      <div id="content-wrapper" class="d-flex flex-column">