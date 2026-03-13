{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='saveReservation'}">
    <div class="row gtr-uniform">
    {if count($patients) > 0}
        <div class="col-12 col-12-xsmall">
            <select name="patientId" id="patientId">
                <option style="display: none;" value="">Wybierz pacjenta</option>
                {foreach from=$patients item=patient}
                    <option value="{$patient->id}" {if $reservation->patientId == $patient->id}selected{/if}>{$patient->name} {$patient->surname} ({$patient->pesel})</option>
                {/foreach}
            </select>
        </div>
    {/if}
        <div class="col-12" id="visitReasonIdDiv" style="display: {if $reservation->customVisitReasonEnable}none{else}block{/if};">
            <select name="visitReasonId" id="visitReasonId">
                <option style="display: none;" value="">Wybierz przyczynę wizyty</option>
                {foreach from=$visitReasons item=visitReason}
                    <option value="{$visitReason->id}" {if $reservation->visitReasonId == $visitReason->id}selected{/if}>{$visitReason->name}</option>
                {/foreach}
            </select>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="checkbox" id="customVisitReasonEnable" name="customVisitReasonEnable" value="1" {if $reservation->customVisitReasonEnable}checked{/if}>
			<label for="customVisitReasonEnable">Inna przyczyna wizyty</label>
        </div>	
        <div class="col-12" id="customVisitReasonDiv" style="display: {if $reservation->customVisitReasonEnable}block{else}none{/if};">
    		<textarea name="customVisitReason" id="customVisitReason" placeholder="Opisz przyczynę wizyty" rows="6" maxlength="100">{$reservation->customVisitReason}</textarea>
    	</div>    
        <div class="col-12">
            <input type="submit" value="Umów" class="primary"/>
        </div>
    </div>
</form>
<script src="{asset_url path="js/textareaCheckboxTrigger.js"}"></script>
{/block}