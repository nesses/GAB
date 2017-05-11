<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle na/span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">[GAB]</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            {foreach from=$modTitlesitems key=title item=name}
               {if $title neq 'login'}
                {if $title eq $current_item}
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
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        {else}
          <form method='POST' action='index.php?module=login&action=doLogout' class="navbar-form navbar-right">
            <button type="submit" class="btn btn-danger">Abmelden</button>
          </form>
                
        {/if}
        </div><!--/.nav-collapse -->
      </div>
    </nav>