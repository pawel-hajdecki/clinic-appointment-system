{if !$msgs->isEmpty()}
	{if $msgs->isError()}
		<div class="message error">
			<h3 class="icon solid fa-exclamation-triangle">Błędy</h3>
			<ol>
				{foreach $msgs->getMessages() as $msg}
					{if $msg->isError()}
						<li>{$msg->text}</li>
					{/if}
				{/foreach}
			</ol>
		</div>
	{/if}

	{if $msgs->isInfo()}
		<div class="message success">
			<h3 class="icon solid fa-check">OK</h3>
			{if $msgs->getNumberOfInfos() == 1}
				{foreach $msgs->getMessages() as $info}
					{if $info->isInfo()}
						<span>{$info->text}</span>
					{/if}
				{/foreach}
			{else}
			<ol>
				{foreach $msgs->getMessages() as $info}
					{if $info->isInfo()}
						<li>{$info->text}</li>
					{/if}
				{/foreach}
			</ol>
			{/if}
		</div>
	{/if}
{/if}