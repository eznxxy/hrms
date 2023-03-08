<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">HRMS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">HR</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::segment(1) == '' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @if (Auth::user()->role_id != 3)
            <li class="{{ Request::segment(1) == 'employees' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('employees.index') }}"><i class="fas fa-users"></i><span>Employee</span></a>
            </li>
            <li class="{{ Request::segment(1) == 'documents' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('documents.index') }}"><i class="fas fa-file-alt"></i><span>Document</span></a>
            </li>
            @if (Auth::user()->role_id == 1)
            <li class="nav-item dropdown {{ Request::segment(1) == 'divisions' || Request::segment(1) == 'positions' ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-code-branch"></i>
                    <span>Structurals</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::segment(1) == 'divisions' ? 'active':'' }}">
                        <a class="nav-link" href="{{ route('divisions.index') }}">Division</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'positions' ? 'active':'' }}">
                        <a class="nav-link" href="{{ route('positions.index') }}">Position</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::segment(1) == 'termination-categories' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('termination_categories.index') }}"><i class="fas fa-folder"></i><span>Termination Category</span></a>
            </li>
            <li class="{{ Request::segment(1) == 'leave-categories' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('leave_categories.index') }}"><i class="fas fa-folder"></i><span>Leave Category</span></a>
            </li>
            @endif
            <li class="{{ Request::segment(1) == 'terminations' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('terminations.index') }}"><i class="fas fa-user-slash"></i><span>Termination</span></a>
            </li>
            @endif
            <li class="{{ Request::segment(1) == 'announcements' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('announcements.index') }}"><i class="fas fa-bullhorn"></i><span>Announcement</span></a>
            </li>
            <li class="{{ Request::segment(1) == 'resignations' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('resignations.index') }}"><i class="fas fa-user-times"></i><span>Resignation</span></a>
            </li>
            <li class="{{ Request::segment(1) == 'leaves' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('leaves.index') }}"><i class="fas fa-user-times"></i><span>Leave</span></a>
            </li>
            <li class="{{ Request::segment(1) == 'reimbursements' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('reimbursements.index') }}"><i class="fas fa-receipt"></i><span>Reimbursement</span></a>
            </li>
            <li class="nav-item dropdown {{ Request::segment(1) == 'salaries' || Request::segment(1) == 'incentives' || Request::segment(1) == 'payrolls' ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-money-bill-alt"></i>
                    <span>Finance</span></a>
                <ul class="dropdown-menu">
                    @if (Auth::user()->role_id != 3)
                    <li class="{{ Request::segment(1) == 'salaries' ? 'active':'' }}">
                        <a class="nav-link" href="{{ route('salaries.index') }}">Salary</a>
                    </li>
                    @endif
                    <li class="{{ Request::segment(1) == 'incentives' ? 'active':'' }}">
                        <a class="nav-link" href="{{ route('incentives.index') }}">Incentive</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'payrolls' ? 'active':'' }}">
                        <a class="nav-link" href="{{ route('payrolls.index') }}">Payroll</a>
                    </li>
                </ul>
            </li>
    </aside>
</div>