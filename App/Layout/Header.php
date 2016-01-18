<!DOCTYPE html>
<html>
<head>
	<!--Import Google Icon Font--> 
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<!--Import materialize.css--> 
	<link type="text/css" rel="stylesheet" href="/App/Layout/Assets/css/materialize.min.css" media="screen,projection" />
	<link type="text/css" rel="stylesheet" href="/App/Layout/Assets/css/custom.min.css" media="screen,projection" />
	<link rel="icon" type="image/png" href="/App/Layout/Assets/ico.png" />
	<!--title page-->
	<title>Internet Banking</title>
	<!--Let browser know website is optimized for mobile--> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!--Import jQuery before materialize.js--> 
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script type="text/javascript" src="/App/Layout/Assets/js/materialize.min.js"></script>  
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();     
		});
	</script>
	<script type="text/javascript" src="/App/Layout/Assets/js/app.min.js"></script>
</head>
<body style="background:#eee;">
	<div class="container z-depth-1" style="background:#fff;min-height:200px;height:100%">
		<ul id="dropdown1" class="dropdown-content ">
			<li><a href="/report">Lançamentos</a></li>
			<li class="divider"></li>
		</ul>
		<nav>
			<div class="nav-wrapper  cyan">
				<a href="#!" class="brand-logo" style="padding-left:10px;"><i class="material-icons left">equalizer</i>[I]nternetBanking</a> 
				<ul class="right hide-on-med-and-down">
					<li>						
					</li>
					<!-- Dropdown Trigger --> 
					<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">trending_down</i>Relatórios<i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
			</div>
		</nav>

		<div>
			<!-- Page Layout here --> 
			<div class="row" style="margin-left:0px;">
				<div class="col s12 m4 l3 cyan lighten-5 menu-side">
					<div class="collection" style="border:0px;margin:0px;">
						<div class="collection-item avatar">
							<img src="/App/Layout/Assets/images/photo.jpg" alt="" class="circle">
							<span class="title">Adriel Oliveira</span>
							<p>Internet Banking <br>
								<small><?php echo date("H:m:s"); ?></small>
							</p>
						</div>

						<a href="/" class="collection-item font-blue			<?php echo $this->setActive("");?>">
							<i class="material-icons left">dashboard</i>			Principal</a>

							<a href="/category" class="collection-item font-blue	<?php echo $this->setActive("category");?>">
								<i class="material-icons left">list</i>	Categorias</a>

								<a href="/releases" class="collection-item	font-blue		<?php echo $this->setActive("releases");?>">
									<i class="material-icons left">view_headline</i>	Lançamentos</a>

								</div>
							</div>
							<div class="col s12 m8 l9" style="padding-left:0px;margin:0px;vertical-align:top;">
								<div>
									<nav style="box-shadow:0 0px 0px 0 rgba(0,0,0,0.12); border-bottom:1px solid #eee">
										<div class="nav-wrapper bg-white">
											<div class="col s12">
												<?php $this->breadCrumb(); ?>
												<div class="right">
													<?php if(in_array($this->getRouter(),array('category','releases','find'))) { ?>
													<form method="post" action="/<?php echo $this->getRouter(); ?>/find">
														<div class="input-field" style="height:64px;width:400px;">
															<input type="hidden" name="find_report" value="<?php echo $this->getRouter(); ?>">
															<input id="search" type="search" name="find_value" placeholder="<?php echo $this->Request('find_value');?>"  required>
															<label for="search"><i class="material-icons font-grey">search</i></label>
															<i class="material-icons">close</i>
														</div>
													</form>	
													<?php } ?>
												</div>
											</div>
										</div>
									</nav>
									<?php  if($message = $this->get('success')){ ?>						  
									<div class="card-panel teal" style="margin:0px">
										<span class="white-text">
											<i class="small material-icons left">info_outline</i>
											<?php echo $message; ?>
										</span>
									</div>
									<?php } ?>