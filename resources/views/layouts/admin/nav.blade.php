<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(Auth::guard('admin')->user()->picture){{Auth::guard('admin')->user()->picture}} @else {{asset('admin-css/dist/img/avatar.png')}} @endif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>
                <a href="{{route('admin.profile')}}">{{ tr('admin') }}</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li id="dashboard">
              <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>{{tr('dashboard')}}</span>
              </a>
              
            </li>

            <li class="treeview" id="users">

                <a href="#">
                    <i class="fa fa-user"></i> <span>{{tr('users')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="add-user"><a href="{{route('admin.add.user')}}"><i class="fa fa-circle-o"></i>{{tr('add_user')}}</a></li>
                    <li id="view-user"><a href="{{route('admin.users')}}"><i class="fa fa-circle-o"></i>{{tr('view_users')}}</a></li>
                </ul>
    
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.categories')}}">
                    <i class="fa fa-suitcase"></i> <span>{{tr('categories')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="add-category"><a href="{{route('admin.add.category')}}"><i class="fa fa-circle-o"></i>{{tr('add_category')}}</a></li>
                    <li id="view-categories"><a href="{{route('admin.categories')}}"><i class="fa fa-circle-o"></i>{{tr('view_categories')}}</a></li>
                </ul>

            </li>

            <li class="treeview" id="videos">
                <a href="{{route('admin.videos')}}">
                    <i class="fa fa-video-camera"></i> <span>{{tr('videos')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="add-video"><a href="{{route('admin.add.video')}}"><i class="fa fa-circle-o"></i>{{tr('add_video')}}</a></li>
                    <li id="view-videos"><a href="{{route('admin.videos')}}"><i class="fa fa-circle-o"></i>{{tr('view_videos')}}</a></li>
                </ul>

            </li>


            <li id="settings">
                <a href="{{route('admin.settings')}}">
                    <i class="fa fa-gears"></i> <span>{{tr('settings')}}</span>
                </a>
            </li>

            <li class="treeview" id="pages">
                <a href="{{route('viewPages')}}">
                    <i class="fa fa-book"></i> <span>{{tr('pages')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add_page"><a href="{{route('addPage')}}"><i class="fa fa-circle-o"></i>{{tr('add_page')}}</a></li>
                    <li id="page_index"><a href="{{route('viewPages')}}"><i class="fa fa-circle-o"></i>{{tr('view_pages')}}</a></li>
                </ul>
            </li>

            <li id="profile">
                <a href="{{route('admin.profile')}}">
                    <i class="fa fa-diamond"></i> <span>{{tr('account')}}</span>
                </a>
            </li>

            <li id="help">
                <a href="{{route('admin.help')}}">
                    <i class="fa fa-question-circle"></i> <span>{{tr('help')}}</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.logout')}}">
                    <i class="fa fa-sign-out"></i> <span>{{tr('sign_out')}}</span>
                </a>
            </li>

        </ul>

    </section>

    <!-- /.sidebar -->

</aside>