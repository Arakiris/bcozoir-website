<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">NAVIGATION</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Actualit&eacute;s</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.actualites.index') }}">Toutes les actualit&eacute;</a></li>
					<li><a href="{{ route('admin.actualites.create') }}">Cr&eacute;ation</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Alertes</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.alertes.index') }}">Toutes les alertes</a></li>
					<li><a href="{{ route('admin.alertes.create') }}">Cr&eacute;ation</a></li>
				</ul>
			</li>
			<li><a href="{{ route('admin.annonces.index') }}"><i class="fa fa-link"></i> <span>Annonces</span></a></li>
			<li><a href="{{ route('admin.categories.index') }}"><i class="fa fa-link"></i> <span>Cat&eacute;gories d'&acirc;ge</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Clubs</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.clubs.index') }}">Tous les clubs inscrits</a></li>
					<li><a href="{{ route('admin.clubs.create') }}">Cr&eacute;ation</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>&Eacute;v&egrave;nements</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.evenements.index') }}">Tous les évènements</a></li>
					<li><a href="{{ route('admin.evenements.create') }}">Cr&eacute;ation</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Membres</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.membres.index') }}">Tous les membres</a></li>
					<li><a href="{{ route('admin.membres.create') }}">Cr&eacute;ation</a></li>
					<li><a href="{{ route('admin.scores') }}">Tous les scores</a></li>
				</ul>
			</li>
			<li><a href="{{ route('admin.liens.index') }}"><i class="fa fa-link"></i> <span>Liens Utiles</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Ligues</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.ligues.index') }}">Toutes les ligues</a></li>
					<li><a href="{{ route('admin.ligues.create') }}">Cr&eacute;ation</a></li>

				</ul>
			</li>
			<li><a href="{{ route('admin.partenaires.index') }}"><i class="fa fa-link"></i> <span>Partenaires</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Tournois</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('admin.tournois.index') }}">Tous les tournois</a></li>
					<li><a href="{{ route('admin.tournois.create') }}">Cr&eacute;ation</a></li>
				</ul>
			</li>
			<li><a href="{{ route('admin.typeTournois.index') }}"><i class="fa fa-link"></i> <span>Type de Tournois</span></a></li>
		</ul>
		
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>