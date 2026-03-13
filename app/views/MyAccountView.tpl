{extends file="main.tpl"}

{block name="content"}

{include file="messages.tpl"}

<div class="table-wrapper">
    <table>
        <tbody>
            <tr>
                <th>Imię</th>
                <td>{$user->name}</td>
            </tr>
            <tr>
                <th>Nazwisko</th>
                <td>{$user->surname}</td>
            </tr>
            {if $user->pesel}
            <tr>
                <th>PESEL</th>
                <td>{$user->pesel}</td>
            </tr>
            {/if}
            <tr>
                <th>Status konta</th>
                <td>{lng_user_status status=$user->status}</td>
            </tr>
        </tbody>
    </table>
</div>

{/block}
