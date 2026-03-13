{extends file="main.tpl"}

{block name="content"}

<script>
    const localFilterPreset =['scheduleFilterForm', '{$conf->action_root}showSchedulePart','scheduleTableWrapper'];
</script>

<div id="messages">
    {include file="messages.tpl"}
</div>

{if !$isPatient}
<div>
    <div class="col-6">
        <a class="button primary small" href="{url action='showNewAppointmentForm'}">Dodaj wizytę</a>
    </div>
</div>
<div class="filter-container" style="margin-top: 2em;">
    <div class="filterIcon">
        <a class="icon solid fa-filter"></a>
    </div>
    <div class = "filterContent">
        <form id="scheduleFilterForm">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-4 col-12-small">
                <input type="text" id="name" name="name" placeholder="Lekarz lub pacjent" value="{$form->name|escape}" 
                oninput="filterTable(...localFilterPreset, true);"
                />
            </div>
            
            <div class="col-3 col-12-small">
                <input 
                    type="{if $form->dateTimeFrom != ''}date{else}text{/if}" 
                    id="dateTimeFrom" 
                    name="dateTimeFrom" 
                    placeholder="Od" 
                    value="{$form->dateTimeFrom|escape}" 
                    onfocus="this.type='date'" 
                    onblur="if(this.value == '') this.type='text';" 
                    onchange="filterTable(...localFilterPreset);"
                />
            </div>

            <div class="col-3 col-12-small">
                <input 
                    type="{if $form->dateTimeTo != ''}date{else}text{/if}" 
                    id="dateTimeTo" 
                    name="dateTimeTo" 
                    placeholder="Do" 
                    value="{$form->dateTimeTo|escape}" 
                    onfocus="this.type='date'" 
                    onblur="if(this.value == '') this.type='text';" 
                    onchange="filterTable(...localFilterPreset);"
                />
            </div>
            
            <div class="col-2 col-12-small">
                <select id="appointmentStatus" name="appointmentStatus" onchange="filterTable(...localFilterPreset);">
                    <option value="" {if $form->appointmentStatus == ''}selected{/if}>Wszystkie</option>
                    <option value="1" {if $form->appointmentStatus == '1'}selected{/if}>Wolne</option>
                    <option value="0" {if $form->appointmentStatus == '0'}selected{/if}>Zajęte</option>
                </select>
            </div>

            <input type="hidden" id="pageInput" name="page" value="1">
        </div>
    </form>
    </div>
</div>

{/if}

<div id="scheduleTableWrapper" class="table-wrapper">
    {include file="ScheduleTable.tpl"}
</div>

{/block}