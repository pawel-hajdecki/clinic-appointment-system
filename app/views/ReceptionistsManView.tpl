{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showRegistrationForm'}">Dodaj</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="receptionistsTable" class="alt">
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Login</th>
                <th style="width: 30%">Akcje</th>
            </tr>
        </thead>
        <tbody>
            {if count($receptionists) == 0}
                <tr>
                    <td colspan="8">Brak recepcjonistów.</td>
                </tr>
            {else}
            {foreach from=$receptionists item=receptionist}
                <tr>
                    <td>{$receptionist->name}</td>
                    <td>{$receptionist->surname}</td>
                    <td>{$receptionist->login}</td>
                    <td>
                        <a class="button primary fit small" href="{url action='deleteReceptionist' param1=$receptionist->id}">Usuń</a>
                        <a class="button primary fit small" href="{url action='editRegistrationData' param1=$receptionist->id}">Edytuj</a>
                        <a class="button primary fit small" href="{url action='showChangePasswordForm' param1=$receptionist->id}">Zmień hasło</a>
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
    </table>
</div>

{/block}
