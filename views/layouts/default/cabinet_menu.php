<ul class="nav flex-column">
    <li class="nav-item">
        <p><a class="nav-link  <?php if($params['activePage'] == 'history_order') { ?>active<?php } ?>"
              href="/cabinet/history_order/">История заказов</a>
        </p>
    </li>
    <li class="nav-item">
        <p><a class="nav-link <?php if($params['activePage'] == 'edit') { ?>active<?php } ?>"
              href="/cabinet/edit/">Редактировать данные</a>
        </p>
    </li>

    <?php if($params['isAdmin']) { ?>
        <li class="nav-item">
            <p><a class="nav-link" href="/admin">Панель администратора</a></p>
        </li>
    <?php } ?>

    <li class="nav-item">
        <p><a class="nav-link" href="/cabinet/logout">Выйти</a></p>
    </li>
</ul>
