{extends file="form_base.tpl"}
{block name="form_content"}
<form method="post" action="{url action='saveDoctor' param1=$doctorId}">
    <div class="row gtr-uniform">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="name" id="name" value="{$doctor->name}" placeholder="Imię"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="text" name="surname" id="surname" value="{$doctor->surname}" placeholder="Nazwisko"/>
        </div>
        <div class="col-12">
            <label for="photoUrl">URL zdjęcia</label>
            <input type="text" name="photoUrl" id="photoUrl" value="{$doctor->photoUrl}" placeholder="URL zdjęcia"/>
        </div>
        <div class="col-12">
            <label for="description">Opis</label>
            <textarea name="description" id="description" rows="4" placeholder="Opis">{$doctor->description}</textarea>
        </div>
        <div class="col-12">
            <label>Specjalizacje</label>
            {foreach from=$allSpecializations item=spec}
                <div>
                    <input type="checkbox" name="specializations[]" id="spec_{$spec.id}" value="{$spec.id}" {if in_array($spec.id, $doctor->specializations)}checked{/if}/>
                    <label for="spec_{$spec.id}">{$spec.name}</label>
                </div>
            {/foreach}
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="checkbox" id="customSpecEnable" name="customSpecEnable" value="1" data-toggle-checkbox="1" data-target-show="customSpecDiv" {if $doctor->newSpecializationsRaw ne ''}checked{/if}>
            <label for="customSpecEnable">Inne specjalizacje</label>
        </div>
        <div class="col-12" id="customSpecDiv" style="display:{if $doctor->newSpecializationsRaw ne ''}block{else}none{/if};">
            <label for="customSpecializations">Nowe specjalizacje (po przecinku)</label>
            <textarea name="customSpecializations" id="customSpecializations" rows="3" placeholder="np. Radiologia interwencyjna, Geriatria">{$doctor->newSpecializationsRaw}</textarea>
        </div>
        <div class="col-12">
            <input type="submit" value="Zapisz" class="primary"/>
        </div>
    </div>
</form>
<script src="{asset_url path="js/textareaCheckboxTrigger.js"}"></script>
{/block}
