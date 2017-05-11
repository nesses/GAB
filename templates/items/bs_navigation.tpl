<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>[GAB]{if $module} - {$modTitles[$module]}{/if}</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- MOMENT CSS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- DateTimePicker -->
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="padding-top: 4rem;">
      
<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">[GAB]</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            {foreach from=$items key=title item=name}
               {if $title neq 'login'}
                {if $title eq $activeItem}
                <li  class="active" ><a href="#about">{$name}</a></li>
                {else}
                <li><a href="index.php?module={$title}">{$name}</a></li>
                {/if}
               {/if}
            {/foreach}
          </ul>
        {if !$login}
          <form method='POST' action='index.php?module=login&action=doLogin' class="navbar-form navbar-right">
            <div class="form-group">
              <input name="username" type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Anmelden</button>
          </form>
        {else}
          <form method='POST' action='index.php?module=login&action=doLogout' class="navbar-form navbar-right">
            <button type="submit" class="btn btn-danger">Abmelden</button>
          </form>
                
        {/if}
        </div><!--/.nav-collapse -->
      </div>
    </nav>
     