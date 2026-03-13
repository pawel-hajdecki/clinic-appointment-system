{extends file="main.tpl"}
{block name="content"}
<div class="box alt">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-6 col-12-medium">
            <span class="image fit"><img src="{asset_url path=($doctor->photoUrl ?? "images/pic01.jpg") type="images"}" alt="Zdjęcie dr {$doctor->name} {$doctor->surname}" /></span>
        </div>
        <div class="col-6 col-12-medium">
            <h2>Dr {$doctor->name} {$doctor->surname}</h2>
            <p>Specjalizacje: {$doctor->specializations}</p>
            <a href="{url action="showSelectAppointment" param1=$doctor->id}" class="button primary fit {if $blockReservation}disabled{/if}"> {if $blockReservation}Twoje konto jest nieaktywne{else}Umów wizytę{/if}</a>
        </div>
        {if $doctor->description}
        <p>Opis: {$doctor->description}</p>
        {/if}
    </div>
</div>
{/block} 