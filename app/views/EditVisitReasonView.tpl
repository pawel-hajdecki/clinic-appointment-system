{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='saveVisitReason' param1=$visitReasonId}">
    <div class="row gtr-uniform">
        <div class="col-12 col-12-xsmall">
            <input type="text" name="name" id="name" value="{$visitReason->name}" placeholder="Nazwa"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="checkbox" id="isEnable" name="isEnable" value="1" {if $visitReason->isEnable}checked{/if}>
			<label for="isEnable">Dostępna</label>
        </div>				
        <div class="col-12">
            <input type="submit" value="Zapisz" class="primary"/>
        </div>
    </div>
</form>
{/block}