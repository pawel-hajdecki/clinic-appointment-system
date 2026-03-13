{extends file="main.tpl"}
{block name="content"}
<div class="row" style="justify-content: center;">
	<div class="col-6 col-12-small">
		{block name=form_content} {/block}
	</div>
	{if !$msgs->isEmpty()}
		<div class="col-6 col-12-small">
			{include file='messages.tpl'}
		</div>
	{/if}
{/block}