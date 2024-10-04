<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
    </form>
    <ul class="nav menu">
        <li class="overview"><a href="{{ url('admin') }}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Overview</a></li>
        <li class="category"><a href="{{ url('admin/category') }}"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper" /></svg>Category</a></li>
        <li class="products"><a href="{{ url('admin/product') }}"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>Products</a></li>
        <li class="orders"><a href="{{ url('admin/order') }}"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad" /></svg>Orders</a></li>
        <li role="presentation" class="divider"></li>
        <li class="manage_members"><a href="{{ url('admin/user') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Manage Members</a></li>
    </ul>
</div>