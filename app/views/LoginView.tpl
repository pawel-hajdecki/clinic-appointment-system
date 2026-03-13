{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='login'}">
	<div class="row gtr-uniform">
	    <div class="col-12">
			<input type="text" name="login" id="login" value="{$form->login ?? null}" placeholder="Login" />
		</div>
		<div class="col-12">
			<input type="password" name="password" id="password" value="" placeholder="Hasło" />
		</div>							
		<div class="col-12" style="justify-content: center;">
			<input type="submit" value="Zaloguj się" class="primary"/>
		</div>
        <div class="col-12" style="margin-top:1em;">
            Nie masz konta? <a href="{url action='showRegistrationForm'}">Zarejestruj się</a>
        </div>
	</div>
</form>

{/block}