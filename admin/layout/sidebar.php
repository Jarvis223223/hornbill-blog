<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../admin/index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
        <i class="fab fa-slack"></i>
    </div>
    <div class="sidebar-brand-text mx-3">HB-BLOG</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li 
    <?php if (isset($_GET['page']) ) :
    ?>
        class="nav-item"
    <?php 
    else :
    ?>
        class="nav-item active"
    <?php 
        endif
    ?>
>
    <a class="nav-link" href="../admin/index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Nav Item - Charts -->
<li 
    <?php 
        if (isset($_GET['page'])) {
            if (isset($_GET['page']) && $_GET['page'] === 'categories' || $_GET['page'] === 'categories-create' || $_GET['page'] === 'categories-edit') {
                echo " class='nav-item active' ";
            }else {
                echo " class='nav-item' ";
            } 
        }else {
            echo " class='nav-item' ";
        }
    ?>
>
  <a class="nav-link" href="index.php?page=categories">
    <i class="fas fa-fw fa-table"></i>
    <span>Category</span>
  </a>
</li>
<li
    <?php 
    if (isset($_GET['page'])) {
        if (isset($_GET['page']) && $_GET['page'] === 'blogs' || $_GET['page'] === 'blogs-create' || $_GET['page'] === 'blogs-edit') {
            echo " class='nav-item active' ";
        } else {
            echo " class='nav-item' ";
        }
    }else {
        echo " class='nav-item' ";
    }
    ?>
>
  <a class="nav-link" href="index.php?page=blogs">
  <i class="fas fa-fw fa-folder"></i>
    <span>Blog</span>
  </a>
</li>
<li 
    <?php 
    if (isset($_GET['page'])) {
        if (isset($_GET['page']) && $_GET['page'] === 'users' || $_GET['page'] === 'users-create' || $_GET['page'] === 'users-edit') {
            echo " class='nav-item active' ";
        } else {
            echo " class='nav-item' ";
        }
    }else {
        echo " class='nav-item' ";
    }
    ?>
>
  <a class="nav-link" href="index.php?page=users">
    <i class="fas fa-solid fa-users"></i>
    <span>User</span>
  </a>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>