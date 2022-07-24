<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/{{ $shareddata['LOGO'] }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/{{ $shareddata['LOGO'] }}" alt="" height="45">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="/{{ $shareddata['LOGO'] }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/{{ $shareddata['LOGO'] }}" alt="" height="45">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="mdi mdi-view-carousel-outline"></i> <span data-key="t-layouts">Categories</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.create') }}" class="nav-link"  data-key="t-horizontal">Create Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link"  data-key="t-horizontal">Category List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBlogs" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBlogs">
                        <i class="mdi mdi-view-carousel-outline"></i> <span data-key="t-layouts">Blog</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBlogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.blog.create') }}" class="nav-link"  data-key="t-horizontal">Create Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blog.index') }}" class="nav-link"  data-key="t-horizontal">Blog List</a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Settings</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.settings.index') }}">
                        <i class="mdi mdi-puzzle-outline"></i> <span data-key="t-widgets">Site Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.user.edit') }}">
                        <i class="mdi mdi-puzzle-outline"></i> <span data-key="t-widgets">Edit Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.logout') }}">
                        <i class="mdi mdi-puzzle-outline"></i> <span data-key="t-widgets">Logout</span>
                    </a>
                </li>

            </ul>
        </div>

    </div>

    <div class="sidebar-background"></div>
</div>
