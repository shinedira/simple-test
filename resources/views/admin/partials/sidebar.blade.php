<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">Test</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">TST</a>
    </div>
    <ul class="sidebar-menu">
        <x-nav
         :menus="[
            [
                 'type' => 'label',
                 'key'  => 'HIGHLIGHT'
            ],
            [
                'key'   => 'Dashboard',
                'name'  => 'dashboard',
                'icon'  => 'fire',
                'route' => route('admin.dashboard')
            ],
            [
                'type' => 'label',
                'key'  => 'FEATURE'
            ],
            [
                'key'   => 'Candidate',
                'name'  => 'candidate',
                'icon'  => 'users',
                'route' => route('admin.candidate.index')
            ],
            [
                 'type' => 'label',
                 'key'  => 'MASTER'
            ],
            [
                'key'   => 'Skills',
                'name'  => 'skill',
                'icon'  => 'clipboard-list',
                'route' => route('admin.skill.index')
            ],
            [
                'key'   => 'HRD',
                'name'  => 'hrd',
                'icon'  => 'users-cog',
                'route' => route('admin.hrd')
            ],
         ]"
        ></x-nav>


    </ul>
</aside>