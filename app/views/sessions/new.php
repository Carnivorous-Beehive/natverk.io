<div class="row center-xs middle-xs full-height">
    <h1>Login</h1>
    <form action="/sessions" method="POST" class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>" />
        <? if(array_key_exists('error', $_SESSION)) { ?>
            <div class="error">
                <?= $_SESSION['error'] ?>
                <? unset($_SESSION['error']) ?>
            </div>
        <? } ?>
        <div class="col-xs-12 input">
            <label>
                Username
                <input type="text" name="username" value="" />
            </label>
        </div>
        <div class="col-xs-12 input">
            <label>
                Password
                <input type="password" name="password" value="" />
            </label>
        </div>
        <div class="col-xs-12 input">
            <input type="submit" name="submit" />
        </div>
    </form>
</div>
