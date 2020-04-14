<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>FORCE BULLS</title>
    
    <!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.structure.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.theme.min.css" type="text/css">
	<!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css">
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/adminlte/plugins/toastr/toastr.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/adminlte/dist/css/adminlte.min.css" type="text/css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.structure.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.theme.min.css" type="text/css" />
  
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" type="text/css" />
	<link href="<?php echo BASE_URL; ?>/assets/images/icon_logo.png" rel="icon"/>


	<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>		 -->
		<!-- <script type="text/javascript" src="../assets/js/jquery-1.7.1.min.js"></script> -->
	</head>
	<body class="hold-transition layout-top-nav  sidebar-mini">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!--<nav class="navbar topnav">
			<div class="container">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php $this->lang->get('LANGUAGE'); ?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo BASE_URL; ?>lang/set/en">English</a></li>
							<li><a href="<?php echo BASE_URL; ?>lang/set/pt-br">Português</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>-->
		<header>
			<div class="container">
				<div class="row">
					<div class="col-sm-2 logo">
						<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/logo3.png" /></a>
					</div>
					<div class="col-sm-6">
						<div class="head_help">(44) 98462-4635</div>
						<div class="head_email">forcebulls@<a href="<?php echo BASE_URL; ?>https://www.forcebulls.com.br">forcebulls.com.br</a></div>
						
						<div class="search_area">
							<form action="<?php echo BASE_URL; ?>busca" method="GET">
								<input type="text" name="s" value="<?php echo (!empty($viewData['searchTerm']))?$viewData['searchTerm']:''; ?>" required placeholder="<?php $this->lang->get('SEARCHFORANITEM'); ?>" />
								<select name="category" class="form-control">

									<option value=""><?php $this->lang->get('ALLCATEGORIES'); ?></option>

									<?php foreach($viewData['categories'] as $cat): ?>
									<option <?php echo ($viewData['category']==$cat['id'])?'selected="selected"':''; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
						        	<?php
						        	if(count($cat['subs']) > 0) {
						        		$this->loadView('search_subcategory', array(
						        			'subs' => $cat['subs'],
						        			'level' => 1,
						        			'category' => $viewData['category']
						        		));
						        	}
						        	?>
						        	<?php endforeach; ?>


									
								</select>
								<input type="submit" value="" />
						    </form>
						</div>
					</div>
					<div class="col-sm-1">
						<a href="<?php echo BASE_URL; ?>cart">
							<div class="cartarea">
								<div class="carticon">
									<div class="cartqt"><?php echo $viewData['cart_qt']; ?></div>
								</div>
								<div class="carttotal" id="compra">
									<?php // $this->lang->get('CART'); ?><br/>
									<?php if($viewData['cart_qt'] == 0) {
										unset($_SESSION['total']);
										$_SESSION['total'] = 0;
										
									} else {
										?>
										
										<span id="cart_price"> <?php // echo number_format($_SESSION['total'], 2, ',', '.'); ?></span>
										
										<?php 
									}
									
									 ?>
									 
									
								</div>
							</div>
						</a>
					</div>
					
						<div class="col-sm-3">					
							<div class="d-block user_area">
								<img src="<?php echo BASE_URL; ?>assets/images/user.png" alt="Usuario">	
								<?php if(!isset($_SESSION['name'])): ?>
									<a href="<?php echo BASE_URL; ?>login" >Acessar</a>
									ou
									<a href="#">Cadastrar</a>
								<?php else: ?>
									<a href="#"><?php echo $_SESSION['name']; ?></a>
									<a href="<?php echo BASE_URL; ?>login/logout">Sair</a>
								<?php endif; ?>
							</div>
						</div>
				</div>
			</div>
    </header>
    <div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
     
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>" class="nav-link">Home</a>
          </li>
          
          <?php foreach($viewData['categories'] as $cat): ?>
              <li class="nav-item dropdown">
                <a  id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                  <?php echo $cat['name']; ?>
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <?php
                    if(count($cat['subs']) > 0) {
                      $this->loadView('menu_subcategory', array(
                        'subs' => $cat['subs'],
                        'level' => 1
                      ));
                    }
                  ?>
                </ul>
              </li>
              
              <?php endforeach; ?>
			  
        </ul>
        <ul class="nav navbar-nav navbar-right">
			<!-- <li class="nav-item dropdown">
				<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?php $this->lang->get('LANGUAGE'); ?>
				<span class="caret"></span></a>
				<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
					<li class="nav-item"><a href="<?php echo BASE_URL; ?>lang/set/en" class="nav-link">English</a></li>
					<li class="nav-item"><a href="<?php echo BASE_URL; ?>lang/set/pt-br" class="nav-link">Português</a></li>
				</ul>
			</li> -->
			<?php if(isset($_SESSION['name'])): ?>
			<li class="nav-item dropdown">
				<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?php $this->lang->get('ACCOUNT'); ?>
				<span class="caret"></span></a>
				<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
					<li class="nav-item"><a href="<?php echo BASE_URL; ?>conta" class="nav-link">Minha Conta</a></li>
					<!-- <li class="nav-item"><a href="<?php echo BASE_URL; ?>lang/set/pt-br" class="nav-link">Português</a></li> -->
				</ul>
			</li>
			<?php endif; ?>
					
		</ul>
				
      </div>

      
    </div>
  </nav>
  
  <!-- /.navbar -->
  <!-- <div class="modal fade" id="modal-sm">
  <script>
      $(document).ready(function(){
        $('#password').on('input', function() {
          $('#manda').prop('disabled', $(this).val(). length < 5);
        })
      })
    </script>

        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Acessar sua conta</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="<?php echo BASE_URL; ?>login/index_action" method="POST" id="form-login">
                <div class="input-group mb-3">
                  <input type="email" name="email" id="email"  class="form-control" placeholder="Email" autofocus>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" id="password" class="form-control" require placeholder="Senha">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                    <p class="mb-1">
                      <a href="forgot-password.html">Esqueci minha senha</a>
                    </p>
                    </div>
                  </div>
                  /.col
                  <div class="col-4">
                    <button type="submit" id="manda" disabled class="btn btn-primary btn-block">Entrar</button>
                  </div>
                /.col
              </div>
              
            </form>
            </div>
          </div>
          /.modal-content
        </div>
        /.modal-dialog
      </div>
      /.modal
   -->
</div>
<!-- ./wrapper -->		
		<section>		
			<div class="container">
				<div class="row">
					<?php if(isset($viewData['sidebar'])): ?>
				  		<div class="col-sm-3">
				  			<?php $this->loadView('sidebar', array('viewData'=>$viewData)); ?>
				  		</div>
				  		<div class="col-sm-9"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
					<?php else: ?>
						<div class="col-sm-12"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
					<?php endif; ?>
				</div>
	    	</div>
	  </section>
	    <footer>
	    	<div class="container">
	    		<div class="row">
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
			  			<div class="widget_body">
			  				
			  				<?php $this->loadView('widget_item', array('list'=>$viewData['widget_featured2'])); ?>

			  			</div>
			  		</div>
				  </div>
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1><?php $this->lang->get('ONSALEPRODUCTS'); ?></h1>
			  			<div class="widget_body">
			  				
			  				<?php $this->loadView('widget_item', array('list'=>$viewData['widget_sale'])); ?>

			  			</div>
			  		</div>
				  </div>
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1><?php $this->lang->get('TOPRATEDPRODUCTS'); ?></h1>
			  			<div class="widget_body">
			  				
			  				<?php $this->loadView('widget_item', array('list'=>$viewData['widget_toprated'])); ?>

			  			</div>
			  		</div>
				  </div>
				</div>
	    	</div>
	    	<div class="subarea">
	    		<div class="container">
	    			<div class="row">
						<div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
            <form action="//b7web.us2.list-manage.com/subscribe/post?u=0d44bd14b441c2648668c0c5c&amp;id=156305bc7f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                <input type="email" value="" name="EMAIL" class="subemail required email" id="mce-EMAIL" placeholder="<?php $this->lang->get('SUBSCRIBETEXT'); ?>">
              <input type="hidden" name="b_0d44bd14b441c2648668c0c5c_156305bc7f" tabindex="-1" value="">
                <input type="submit" value="<?php $this->lang->get('SUBSCRIBEBUTTON'); ?>" name="subscribe" id="mc-embedded-subscribe" class="button">
            </form>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="links">
	    		<div class="container">
	    			<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo BASE_URL; ?>"><img width="150" src="<?php echo BASE_URL; ?>assets/images/logo3.png" /></a><br/><br/>
							<strong>FORCE BULLS A MARCA DOS FORTES.</strong><br/><br/>
							Endereço Rua Miguel Ferreira da Costa Brasilândia do Sul, Paraná 87595-000, Brasil (44) 98462-4635
						</div>
						<div class="col-sm-8 linkgroups">
							<div class="row">
								<div class="col-sm-4">
									<h3><?php $this->lang->get('CATEGORIES'); ?></h3>
									<ul>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h3><?php $this->lang->get('INFORMATION'); ?></h3>
									<ul>
										<li><a href="#">Menu 1</a></li>
										<li><a href="#">Menu 2</a></li>
										<li><a href="#">Menu 3</a></li>
										<li><a href="#">Menu 4</a></li>
										<li><a href="#">Menu 5</a></li>
										<li><a href="#">Menu 6</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h3><?php $this->lang->get('INFORMATION'); ?></h3>
									<ul>
										<li><a href="#">Menu 1</a></li>
										<li><a href="#">Menu 2</a></li>
										<li><a href="#">Menu 3</a></li>
										<li><a href="#">Menu 4</a></li>
										<li><a href="#">Menu 5</a></li>
										<li><a href="#">Menu 6</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="copyright">
	    		<div class="container">
	    			<div class="row">
						<div class="col-sm-6">© <span>FORCE BULLS</span> - <?php $this->lang->get('ALLRIGHTRESERVED'); ?>.</div>
						<div class="col-sm-6">
							<div class="payments">
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    </footer>
		<script type="text/javascript">
		var BASE_URL = '<?php echo BASE_URL; ?>';
		<?php if(isset($viewData['filters'])): ?>
		var maxslider = <?php echo $viewData['filters']['maxslider']; ?>;
		<?php endif; ?>
    </script>
    <!-- jQuery -->
    <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/jquery/jquery-ui.min.js"></script> -->
    <!-- Bootstrap 4 -->
  <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/toastr/toastr.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo BASE_URL; ?>assets/adminlte/dist/js/adminlte.min.js"></script>
		
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/adminlte/dist/js/demo.js"></script>
  
	<script type="text/javascript">
		var BASE_URL = '<?php echo BASE_URL; ?>';
		<?php if(isset($viewData['filters'])): ?>
		var maxslider = <?php echo $viewData['filters']['maxslider']; ?>;
		<?php endif; ?>
    </script>
    
    <script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Produto Adicionado com sucesso!.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });

</script>

	<script type="text/javascript">
	$(document).ready(function () {
	$.validator.setDefaults({
		submitHandler: function () {
		alert( "Form successful submitted!" );
		}
	});
	$('#quickForm').validate({
		rules: {
		name: {
			required: true,
			name: true,
		},
		terms: {
			required: true
		},
		},
		messages: {
		name: {
			required: "Digite seu nome para prosseguir!"
		}
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
		error.addClass('invalid-feedback');
		element.closest('.form-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
		$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
		$(element).removeClass('is-invalid');
		}
	});
	});
	</script>
	</body>
</html>