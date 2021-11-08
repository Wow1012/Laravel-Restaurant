<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" width="110" class="" src="{{url('uploads/logo.jpg')}}" /> <br>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->name}}</strong>
                             </span> <span class="text-muted text-xs block">{{Auth::user()->name}} <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{url('settings/profile')}}">@lang('menu.profile')</a></li>
                            
                            <li><a href="{{ url('/logout') }}">@lang('menu.logout')</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        
                    </div>
                </li>
				
				 <li @if(Request::segment(1) == "admin" or Request::segment(1) == "dashboard") class="active" @endif><a href="{{ url('dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.dashboard')<span></a></li>
				 @if(role_permission(2))
				 <li @if(Request::segment(1) == "sales" and Request::segment(2) == "create") class="active" @endif><a href="{{ url('sales/create') }}"><i class="fa fa-diamond"></i> <span class="nav-label">@lang('menu.point_of_sale')<span></a></li>
				 @endif
                 @if(role_permission(12))
				 <li @if(Request::segment(1) == "expenses") class="active" @endif><a href="{{ url('expenses') }}"><i class="fa fa-diamond"></i> <span class="nav-label">@lang('menu.expenses')<span></a></li>
				 @endif
                 @if(role_permission(1))
				 
				  <li  @if((Request::segment(1) == "orders" or Request::segment(1) == "sales") and Request::segment(2) == "") class="active" @endif>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.sales')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(Request::segment(1) == "sales" and Request::segment(2) == "") class="active" @endif><a href="{{ url('sales') }}">@lang('menu.pos_sales')</a></li>
                        
                    </ul>
                </li>
				@endif
                
                @if(role_permission(8))
				
                <li @if((Request::segment(1) == "categories" or Request::segment(1) == "products") and Request::segment(2) == "") class="active" @endif>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.products')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(Request::segment(1) == "categories" and Request::segment(2) == "") class="active" @endif><a href="{{ url('categories') }}">@lang('menu.categories')</a></li>
                        <li @if(Request::segment(1) == "products" and Request::segment(2) == "") class="active" @endif><a href="{{ url('products') }}">@lang('menu.products')</a></li>
                       
                    </ul>
                </li>
			
                   
                @endif
                
                @if(role_permission(17))
                
                <li <?php if(Request::segment(1) == "reports") { ?>  class="active"; <?php  } ?>>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.reporting')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "sales")) class="active" @endif><a href="{{ url('reports/sales') }}">@lang('menu.sales_report')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "sales_by_products")) class="active" @endif><a href="{{ url('reports/sales_by_products') }}">@lang('menu.product_by_sales')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "graphs")) class="active" @endif><a href="{{ url('reports/graphs') }}">@lang('menu.graphs')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "expenses")) class="active" @endif><a href="{{ url('reports/expenses') }}">@lang('menu.expense_report')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "staff_log")) class="active" @endif><a href="{{ url('reports/staff_log') }}">@lang('menu.staff_logs')</a></li>
						
						<li @if((Request::segment(1) == "reports" and Request::segment(2) == "staff_sold")) class="active" @endif><a href="{{ url('reports/staff_sold') }}">@lang('menu.sales_manager_sold')</a></li>
						
                       
                    </ul>
                </li>
				
                @endif
                @if(role_permission(15))
				 <li @if(Request::segment(2) == "general") class="active" @endif>
                    <a href="{{ url('settings/general') }}"><i class="fa fa-gear"></i> <span class="nav-label"> @lang('menu.settings')</span></a>
                </li>
                @endif
				
               
                @if(Auth::user()->role_id != 3)
                <li @if(Request::segment(1) == "rooms") class="active" @endif>
                    <a href="{{ url('rooms') }}"><i class="fa fa-list"></i> <span class="nav-label"> @lang('Zone')</span></a>
                </li>
                <li @if(Request::segment(1) == "tables" and Request::segment(2) == "") class="active" @endif>
                    <a href="{{ url('tables') }}"><i class="fa fa-list"></i> <span class="nav-label"> @lang('menu.tables')</span></a>
                </li>
                <li @if(Request::segment(1) == "tables" and Request::segment(2) == "map") class="active" @endif>
                    <a href="{{ url('tables/map') }}"><i class="fa fa-list"></i> <span class="nav-label"> @lang('Gestione Tavoli')</span></a>
                </li>

                 <li @if(Request::segment(1) == "printers" and Request::segment(2) == "") class="active" @endif>
                    <a href="{{ url('printers') }}"><i class="fa fa-print"></i> <span class="nav-label"> @lang('Stampanti')</span></a>
                </li>
                
                @endif

                @if(role_permission(20))
               
                <li @if(Request::segment(1) == "users") class="active" @endif>
                    <a href="{{ url('users') }}"><i class="fa fa-users"></i> <span class="nav-label"> @lang('menu.users')</span></a>
                </li>
				
                @endif

                 @if(role_permission(18))
				
				<li @if(Request::segment(1) == "roles") class="active" @endif>
                    <a href="{{ url('roles') }}"><i class="fa fa-users"></i> <span class="nav-label"> @lang('menu.roles')</span></a>
                </li>
                @endif
				
                
               
                
				<li @if((Request::segment(2) == "profile" )) class="active" @endif>
                    <a href="{{url('settings/profile')}}"><i class="fa fa-user"></i> <span class="nav-label"> @lang('menu.profile') </span></a>
                </li>
                <li>
                    <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> <span class="nav-label"> @lang('menu.logout') </span></a>
                </li>
                
            </ul>

        </div>
    </nav>
