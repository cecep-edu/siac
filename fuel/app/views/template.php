<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
       <?php echo Asset::css('siac.css'); ?>


</head>
<body>


<?php if (\Session::get_flash('siac-message')): ?>
  <div class="siac-message alert alert-<?php echo array_keys(\Session::get_flash('siac-message'))[0]; ?> alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>SIAC:</strong> <?php echo array_values(\Session::get_flash('siac-message'))[0]; ?>
  </div>
<?php endif; ?>

<nav class="navbar navbar-inverse" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">SIAC</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="infopersonal/">Perfil Profesional</a></li>
          <li class="divider"></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php if (Auth::check()): ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="/usuarios">Listado</a></li>
        </ul>
      </li>
    <?php endif; ?>
    <?php if ( ! Auth::check()): ?>
      <li><a href="/usuarios/login">Conectar</a></li>
    <?php else: ?>
      <li><a href="/usuarios/logout">Desconectar</a></li>
    <?php endif; ?>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>


	<div class="container">


		<div class="col-md-12">
			<?php echo $content; ?>
		</div>
		


		<footer>
			
		</footer>



	</div>

<?php echo Asset::js('jquery.js') ?>
<?php echo Asset::js('bootstrap.js'); ?>
<?php echo Asset::js('bootstrap-typeahead.js'); ?>
<?php echo Asset::js('siac.js'); ?>

</body>
</html>
