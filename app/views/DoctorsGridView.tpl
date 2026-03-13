{extends file="main.tpl"}
{block name="content"}
<div class="box alt">
	<div class="row gtr-60 gtr-uniform">
        {foreach $doctors as $doctor}
		<div class="col-3 col-4-medium col-6-small col-12-xsmall">
            <span class="image fit"><img src="{asset_url path=($doctor->photoUrl ?? "images/pic01.jpg") type="images"}" alt="Zdjęcie dr {$doctor->name} {$doctor->surname}" /></span>
            <h2>{$doctor->name}<br/>{$doctor->surname}</h2>
            <p style="height: 4em;">Specjalizacja: <br/> {$doctor->specializations}</p>
            <a href="{url action='showDoctorDetails' param1=$doctor->id}" class="button fit small">Wybierz</a>
        </div>
        {/foreach}
	</div>
</div>
{/block}