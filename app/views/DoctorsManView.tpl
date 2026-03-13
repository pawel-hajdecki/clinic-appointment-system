{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showDoctorForm'}">Dodaj</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="doctorsTable" class="alt">
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Specjalizacje</th>
                <th style="width: 30%">Akcje</th>
            </tr>
        </thead>
        <tbody>
            {if count($doctors) == 0}
                <tr>
                    <td colspan="8">Brak lekarzy.</td>
                </tr>
            {else}
            {foreach from=$doctors item=doctor}
                <tr>
                    <td>{$doctor->name}</td>
                    <td>{$doctor->surname}</td>
                    <td>{$doctor->specializations}</td>
                    <td>
                        <a class="button primary fit small" href="{url action='deleteDoctor' param1=$doctor->id}">Usuń</a>
                        <a class="button primary fit small" href="{url action='showDoctorForm' param1=$doctor->id}">Edytuj</a>
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
    </table>
</div>

{/block}
