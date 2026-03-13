{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div  class="row apo-list" style="justify-content: center;">
    {if count($appointments) >0}
    {foreach from=$appointments item=appointment}
    <div class="row" style="width: 80%; justify-content: center;">
        <div class="col-4 col-6-small">
            <h2>{$appointment->date}</h2>
        </div>
        <div class="col-4 col-6-small">
             <h3>{$appointment->startTime}-{$appointment->endTime}</h3>
        </div>
        <div class="col-4 col-12-small">
            <a href="{url action='selectAppointment' param1=$appointment->id}" class="button fit small">Wybierz</a>
        </div>
    </div>
    {/foreach}
    {else}
        <h2>Brak dostępnych wizyt</h2>
    {/if}
</div>

{/block}