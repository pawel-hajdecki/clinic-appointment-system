{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='changePassword'}">
    <div class="row gtr-uniform">
        <div class="col-12">
            <input type="password" name="new_password" id="new_password" placeholder="Nowe hasło" value="{$form->new_password}" />
        </div>
        <div class="col-12">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Potwierdź nowe hasło" value="{$form->confirm_password}" />
        </div>
        <div class="col-12">
            <input type="submit" value="Zmień hasło" class="primary" />
        </div>
    </div>
</form>
{/block}
