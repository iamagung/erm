				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<span class="btn btn-success ace-icon fa fa-signal"></span>

						<span class="btn btn-info ace-icon fa fa-pencil"></span>

						<span class="btn btn-warning ace-icon fa fa-users"></span>

						<span class="btn btn-danger ace-icon fa fa-cogs"></span>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success "></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="{{ ($data['active'] == 1) ? 'active' : ''}}">
						<a href="{{ route('dashboard') }}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard</span>
						</a>
						<b class="arrow"></b>
					</li>
					<!-- <li class="{{ ($data['active'] == 2) ? 'active' : ''}}">
						<a href="{{ route('dashboard') }}">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text"> Data Barang Masuk</span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="{{ ($data['active'] == 3) ? 'active' : ''}}">
						<a href="{{ route('dashboard') }}">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text"> Data Barang Keluar</span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="{{ ($data['active'] == 4) ? 'active' : ''}}">
						<a href="{{ route('dashboard') }}">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Data Stok Barang</span>
						</a>
						<b class="arrow"></b>
					</li>
					<li class="{{ ($data['active'] == 5) ? 'active' : ''}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Neraca
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{ route('logo') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Barang
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ route('logo') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Stok Barang
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ route('logo') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Harga Sewa
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li> -->
					<li class="{{ ($data['active'] == 6) ? 'active' : ''}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text">
								Data Master
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{ route('barang') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Data Barang
								</a>

								<b class="arrow"></b>
							</li>

							<!-- <li class="">
								<a href="{{ route('logo') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Stok Barang
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ route('logo') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Harga Sewa
								</a>

								<b class="arrow"></b>
							</li> -->

						</ul>
					</li>

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>