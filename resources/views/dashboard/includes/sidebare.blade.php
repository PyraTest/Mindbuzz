<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
       <div class="main-menu-content">
              <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                     <li class="nav-item active"><a href="/dashboard"><i
                                          class="la la-mouse-pointer"></i><span class="menu-title"
                                          data-i18n="nav.add_on_drag_drop.main">@lang('admin.dashboard') </span></a>
                     </li>
     
 
                    <li class="nav-item  <?php if($active_links[0] == 'users')  echo 'open'; ?> "><a href="">
                     <i class="la la-group"></i>
                     <span class="menu-title"
                             data-i18n="nav.dash.main">{{__('admin.admins')}}</span>
                     <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                     </span>
             </a>
             <ul class="menu-content">
                     <li class="<?php if($active_links[1] === 'showusers') echo 'active'; ?> "><a
                                     class="menu-item" href="{{route('admin.programs')}}"
                                     data-i18n="nav.dash.ecommerce"> {{__('admin.show_all')}} </a>
                     </li>

                     <li class="<?php if($active_links[1] === 'addcities') echo 'active'; ?>"><a
                                                 class="menu-item" href="{{route('admin.add_program')}}"
                                                 data-i18n="nav.dash.crypto">{{__('admin.add_dashboard_admins')}}</a>
                                   </li>

             </ul>
         </li>




                    <li class="nav-item  <?php if($active_links[0] == 'users')  echo 'open'; ?> "><a href="">
                     <i class="la la-group"></i>
                     <span class="menu-title"
                             data-i18n="nav.dash.main">{{__('admin.admins')}}</span>
                     <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                     </span>
             </a>
             <ul class="menu-content">
                     <li class="<?php if($active_links[1] === 'showusers') echo 'active'; ?> "><a
                                     class="menu-item" href="{{route('admin.schools')}}"
                                     data-i18n="nav.dash.ecommerce"> {{__('admin.show_all')}} </a>
                     </li>

                     <li class="<?php if($active_links[1] === 'addcities') echo 'active'; ?>"><a
                                                 class="menu-item" href="{{route('admin.create_school')}}"
                                                 data-i18n="nav.dash.crypto">{{__('admin.add_dashboard_admins')}}</a>
                                   </li>

             </ul>
         </li>







                 







              </ul>
       </div>
</div>
