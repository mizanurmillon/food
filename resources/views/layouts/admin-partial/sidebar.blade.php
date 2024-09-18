 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-dark">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
      <img src="{{ URL::to('public/backend/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light"><i class="fa-solid fa-fire text-hide"></i></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('admin.home') }}" class="nav-link">
              <i class="nav-icon fa fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subcategory') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('beverage') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Beverage</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Offers
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('coupon') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupon</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Food
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('food') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Food</p>
                </a>
              </li>
            </ul>
          </li>
          
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Reservation
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('reservation') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservation Manage</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('pending.reservation') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Reservation</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Blog
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('blog.category') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('blog') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Post</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Client say
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pending.review') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Review</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Setup
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customer') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('floor') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Floor Manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('table') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Table Manage</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Setting
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('setting.seo') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('setting') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website Setting</p>
                </a>
              </li>
              <li class="nav-item">
               <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page Create</p>
                </a>
              </li>
              <li class="nav-item">
               <a href="{{ route('smtp.setting') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMTP Setting</p>
                </a>
              </li>
              <li class="nav-item">
               <a href="{{ route('payment.gateway') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Gateway</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header">HRM</li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Employee
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('designation') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Designation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('department') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('award') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Award</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Job Card</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Leave & Holiday
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('holiday') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Holiday</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('leavetype') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leave Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('leave') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leave Application</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Attendance
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('single.attendance') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Single Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('leavetype') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulk Attendance</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('all.attendance') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('attendance.adjustment') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Adjustment</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Loan & Advance
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('expensetype') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grant Loan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expense') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grant Advance</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Payroll
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('expensetype') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salary Generate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expense') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salary Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Expense
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('expensetype') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('expense') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>