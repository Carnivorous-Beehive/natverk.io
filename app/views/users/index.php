<ul>
    <? foreach ($users as $user) { ?>
    <li>
        <a href="/users/<?= $user->username ?>"><?= $user->username ?></a>
    </li>
    <? } ?>
</ul>