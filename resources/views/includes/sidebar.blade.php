  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
    <img src="{{ url('/storage/settings/'.settings()->get('app_logo')) }}" alt=".." class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ settings()->get('app_name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if (auth()->user()->avatar == null)
            <img class="img-circle elevation-2" 
                src="{{url('/storage/avatars/sample.png')}}"
                alt="User profile picture">    
        @else
            <img class="img-circle elevation-2" 
                src="{{url('/storage/avatars/'.auth()->user()->id.'/'.auth()->user()->avatar)}}"
                alt="User profile picture"> 
        @endif
        </div>
        <div class="info">
        <a href="{{ route('home') }}" class="d-block">{{auth()->user()->name}}</a>
        </div>
    </div>

    
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="#" class="nav-link ">
                <i class="fas fa-blog"></i>
            <p>
                Blog
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('articles.index') }}" class="nav-link">
                    <i class="far fa-newspaper"></i>
                    <p>All Articles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('articles.create') }}" class="nav-link">
                    <i class="far fa-newspaper"></i>
                    <p>Create Article</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                    <i class="fas fa-layer-group"></i>
                    <p>Categories</p>
                    </a>
                </li>
           
            </ul>
        </li>
        @can('app-setting')
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="far fa fa-cog" aria-hidden="true"></i>
                <p>
                        Settings 
                </p>
                </a>
            </li>
        @endcan
        
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside> 