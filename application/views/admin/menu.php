<div id="navbar-example" class="navbar navbar-static">
              <div class="navbar-inner">
                <div class="container" style="width: auto;">
                  <a class="brand" href="#">Админ Панель</a>
                  <ul class="nav" role="navigation">
				
					<li class="dropdown">
					  <a id="drop2" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Контент<b class="caret"></b></a>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
						<li><a tabindex="-1" href="/admin/nodes">Статьи</a></li>
						<li><a tabindex="-1" href="/admin/terms/catalogs">Рубрикатор</a></li>
						<li><a tabindex="-1" href="/admin/terms/tags">Теги</a></li>
					  </ul>
					</li>					
                  </ul>
				  
                  <ul class="nav pull-right">
                    <li id="fat-menu" class="dropdown">
                      <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Пользователь<b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                        <li><a tabindex="-1" href="#">Профиль</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="#" id="user_logout">Выйти</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
<script>
$('.dropdown-toggle').dropdown();
</script>