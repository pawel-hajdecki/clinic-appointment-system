{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showVisitReasonForm'}">Dodaj</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="scheduleTable" class="alt">
        <thead>
            <tr>
                <th>Przyczyna wizyty</th>
                <th>Dostępna</th>
                <th style="width: 30%;">Akcje</th>
            </tr>
        </thead>
        <tbody>
            {if count($visitReasons) == 0}
                <tr>
                    <td colspan="8">Brak predefiniowantch przyczyn wizyt.</td>
                </tr>
            {else}
            {foreach from=$visitReasons item=visitReason}
                <tr>
                    <td>{$visitReason->name}</td>
                    <td>{$visitReason->isEnable ? "TAK" : "NIE"}</td>
                    <td>
                        <a class="button primary fit small" href="{url action='deleteVisitReason' param1=$visitReason->id}">Usuń</a>
                        <a class="button primary fit small" href="{url action='showVisitReasonForm' param1=$visitReason->id}">Edytuj</a>
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
    </table>
</div>

{/block}