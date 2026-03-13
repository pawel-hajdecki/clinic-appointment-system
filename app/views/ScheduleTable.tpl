<script>
    const localPaginationPreset =['scheduleFilterForm', '{$conf->action_root}showSchedulePart','scheduleTableWrapper'];
</script>

    <table id="scheduleTable" class="alt">
        <thead>
            <tr>
                <th>Data</th>
                <th>Godzina</th>
                <th>Gabinet</th>
                <th>Lekarz</th>
                {if $isPatient}
                    <th>Przyczyna wizyty</th>
                {else}
                    <th>Wolny</th>
                {/if}
                <th style="width: 10%;">Akcje</th>
            </tr>
        </thead>
        <tbody>
            {if count($appointments) == 0}
                <tr>
                    <td colspan="8">No appointments.</td>
                </tr>
            {else}
            {foreach from=$appointments item=appointment}
                <tr>
                    <td>{$appointment->date}</td>
                    <td>{$appointment->startTime}-{$appointment->endTime}</td>
                    <td>{$appointment->officeName}</td>
                    <td>{$appointment->doctor->name} {$appointment->doctor->surname}</td>
                    {if $isPatient}
                        <td>{$appointment->visitReason}</td>
                    {else}
                        <td>{$appointment->isAvailable ? "TAK" : "NIE"}
                            {if !$appointment->isAvailable}
                            <br/>
                            {$appointment->patientName} {$appointment->patientSurname} ({$appointment->patientPesel})
                            <br/>
                            {$appointment->visitReason}
                            {/if}
                        </td>
                    {/if}
                    <td>
                        {if $isPatient}
                            {if !$appointment->isAvailable}
                                <a class="button primary fit small" href="{url action='cancelAppointment' param1=$appointment->id}">Anuluj</a>
                            {/if}
                        {else}
                            <a class="button primary fit small" onclick="confirmLink('{url action='deleteAppointment' param1=$appointment->id}', 'Czy na pewno chcesz usunąć tę wizytę?')">Usuń</a>
                            <a class="button primary fit small" href="{url action='editAppointment' param1=$appointment->id}">Edytuj</a>
                            {if $appointment->isAvailable == true}
                                <a class="button primary fit small" href="{url action='bookAppointment' param1=$appointment->id}">Umów</a>
                            {else}
                                <a class="button primary fit small" onclick="confirmLink('{url action='cancelAppointment' param1=$appointment->id}', 'Czy na pewno chcesz anulować tą wizytę?')">Anuluj</a>
                            {/if}
                        {/if}
                    </td>
                </tr>
            {/foreach}
            {/if}
        </tbody>
    </table>
{if $pagination->isPreviousPage || $pagination->isNextPage}
<div class="pagination">
    <button {if !$pagination->isPreviousPage}disabled {/if}class="primary small icon solid fa-chevron-left" onclick="changePage({$pagination->currentPage - 1}, ...localPaginationPreset);"></button>
    <button id="shv-nextPage" {if !$pagination->isNextPage}disabled {/if} class="primary small icon solid fa-chevron-right" onclick="changePage({$pagination->currentPage + 1}, ...localPaginationPreset)"></button>
</div>
{/if}
