<?php $color = array('text-green', 'text-aqua', 'text-yellow','text-primary','text-indigo'); ?>
<aside class="main-sidebar">
	<div class="user-panel">
        <div class="pull-left image">
            <img src="{{ url('assets/img/avatar5.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ auth()->user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <section class="sidebar">
        <ul class="sidebar-menu">
        	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard {{ $color[array_rand($color,1)] }}"></i> <span>Dashboard</span></a></li>

            <li class="@yield('employee')"><a href="{{ route('employee.index') }}"><i class="fa fa-user {{ $color[array_rand($color,1)] }}"></i> <span>Employee</span></a></li>
                
        </ul>
    </section>
</aside>
