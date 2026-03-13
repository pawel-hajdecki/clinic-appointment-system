{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='saveAppointment' param1=$appointmentId}">
    <div class="row gtr-uniform">
        <div class="col-12 col-12-xsmall">
            <input type="text" name="date" id="date" value="{$appointment->date}" placeholder="Data wizyty"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="text" name="startTime" id="startTime" value="{$appointment->startTime}" placeholder="Godzina rozpoczęcia"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="text" name="endTime" id="endTime" value="{$appointment->endTime}" placeholder="Godzina zakończenia"/> 
        </div>
        <div class="col-6 col-12-xsmall">
            <select name="doctorId" id="doctorId">
                <option style="display: none;" value="">Wybierz lekarza</option>
                {foreach from=$doctors item=doctor}
                    <option value="{$doctor->id}" {if $appointment->doctorId == $doctor->id}selected{/if}>{$doctor->name} {$doctor->surname}</option>
                {/foreach}
            </select>
        </div>
        <div class="col-6 col-12-xsmall">
            <select name="officeId" id="officeId">
                <option style="display: none;" value="">Wybierz gabinet</option>
                {foreach from=$offices item=office}
                    <option value="{$office->id}" {if $appointment->officeId == $office->id}selected{/if}>{$office->name}</option>
                {/foreach}
            </select>
        </div>						
        <div class="col-12">
            <input type="submit" value="Zapisz" class="primary" />
        </div>
    </div>
</form>
{/block}