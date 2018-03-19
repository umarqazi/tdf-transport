<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid margin-right-15">
        <div class="navbar-header">
            <a class="navbar-brand bariol-thin" href="#">{{$app_name}}</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-main-menu">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="nav-main-menu">
            <ul class="nav navbar-nav">
                @if(isset($menu_items))
                    @foreach($menu_items as $item)
                        <?php $submenu=$item->getSubmenu(); ?>
                        <li class="{!! LaravelAcl\Library\Views\Helper::get_active_route_name($item->getRoute()) !!} dropdown "> <a href="{!! $item->getLink() !!}" class="pull-left {{(!empty($submenu))? 'dropdown-toggle': ''}}" {{(!empty($submenu))? 'data-toggle=dropdown': ''}}>{!!$item->getName()!!}</a>
                            @if(!empty($submenu))
                                <a class="dropdown-toggle align-arrow pull-left" data-toggle="dropdown" href="#"> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                @foreach($submenu as $item2)
                                      <li class=""> <a href="{!! $item2['link'] !!}">{!!$item2['name']!!}</a>
                                      </li>
                                @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="navbar-nav nav navbar-right">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropdown-profile">
                        @include('laravel-authentication-acl::admin.layouts.partials.avatar', ['size' => 30])
                        <span id="nav-email">{!! isset($logged_user) ? $logged_user->email : 'User' !!}</span> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                            <li>
                                <a href="{!! URL::route('users.selfprofile.edit') !!}"><i class="fa fa-user"></i> Your profile</a>
                            </li>
                            <li class="divider"></li>
                        <li>
                            <a href="{!! URL::route('user.logout') !!}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </div><!-- nav-right -->
        </div><!--/.nav-collapse -->
    </div>
</div>