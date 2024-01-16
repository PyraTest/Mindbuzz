<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="/dashboard"><i class="la la-mouse-pointer"></i><span class="menu-title"
                        data-i18n="nav.add_on_drag_drop.main">@lang('admin.dashboard') </span></a>
            </li>


            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.programs') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.programs') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_program') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_program') }}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.schools') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.schools') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_school') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_school') }}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.stages') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.stages') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_stage') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_school') }}</a>
                    </li>

                </ul>
            </li>

            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.courses') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.courses') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_course') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_school') }}</a>
                    </li>
                </ul>
            </li>
            {{-- Start units --}}
            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.units') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.units') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_unit') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_unit') }}</a>
                    </li>
                </ul>
            </li>
            {{-- End units --}}

            {{-- Start tests --}}
            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.tests') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.tests') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_test') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_test') }}</a>
                    </li>
                </ul>
            </li>
            {{-- End tests --}}

            {{-- Start questions --}}
            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.questions') }}</span>
                    <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.questions') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item"
                            href="{{ route('admin.create_question') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_question') }}</a>
                    </li>
                </ul>
            </li>
            {{-- End questions --}}
            {{-- Start benchmarks --}}
            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.benchmark') }}</span>
                    {{-- <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span> --}}
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.benchmarks') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item"
                            href="{{ route('admin.create_benchmark') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_benchmark') }}</a>
                    </li>
                </ul>
            </li>
            {{-- End benchmarks --}}
            {{-- Start endings --}}
            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.ending') }}</span>
                    {{-- <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span> --}}
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.endings') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item" href="{{ route('admin.create_ending') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_ending') }}</a>
                    </li>
                </ul>
            </li>
            {{-- End endings --}}

            {{-- Start beginnings --}}
            <li class="nav-item  <?php if ($active_links[0] == 'users') {
                echo 'open';
            } ?> "><a href="">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ __('admin.beginning') }}</span>
                    {{-- <span class="badge badge badge-success badge-pill float-right mr-2">Placeholder
                    </span> --}}
                </a>
                <ul class="menu-content">
                    <li class="<?php if ($active_links[1] === 'showusers') {
                        echo 'active';
                    } ?> "><a class="menu-item" href="{{ route('admin.beginnings') }}"
                            data-i18n="nav.dash.ecommerce"> {{ __('admin.show_all') }} </a>
                    </li>

                    <li class="<?php if ($active_links[1] === 'addcities') {
                        echo 'active';
                    } ?>"><a class="menu-item"
                            href="{{ route('admin.create_beginning') }}"
                            data-i18n="nav.dash.crypto">{{ __('admin.add_beginning') }}</a>
                    </li>
                </ul>
            </li>
            {{-- End beginnings --}}
        </ul>
    </div>
</div>
