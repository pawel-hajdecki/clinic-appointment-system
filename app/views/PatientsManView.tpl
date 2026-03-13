{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}
{if $isReceptionist}
<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showRegistrationForm'}">Zarejestruj nowego pacjenta</a>
    </div>
</div>
{/if}
<div class="table-wrapper">
    <table id="patientsTable" class="alt">
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>PESEL</th>
                <th>Status konta</th>
                <th style="width: 30%">Akcje</th>
            </tr>
        </thead>
        <tbody>
            {if count($patients) == 0}
                <tr>
                    <td colspan="5">Brak pacjentów.</td>
                </tr>
            {else}
            {foreach from=$patients item=patient}
                <tr>
                    <td>{$patient->name}</td>
                    <td>{$patient->surname}</td>
                    <td>{$patient->pesel}</td>
                    <td>{lng_user_status status=$patient->status}</td>
                    <td>
                        {if $isReceptionist}
                            {if $patient->status == 'active'}
                                <button class="button fit small disabled" disabled>Deklaracja złożona</button>
                            {else}
                                <a class="button primary fit small" href="{url action='confirmDeclaration' param1=$patient->id}">Potwierdź złożenie deklaracji</a>
                            {/if}
                        {/if}
                        {if $isAdmin}
                            <a class="button primary fit small" href="{url action='deletePatient' param1=$patient->id}">Usuń</a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
    </table>
</div>

{/block}
