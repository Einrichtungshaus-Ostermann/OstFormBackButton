
{* file to extend *}
{extends file="parent:frontend/forms/index.tpl"}

{* set namespace *}
{namespace name="frontend/ost-form-back-button/forms/index"}



{* ... *}
{block name='frontend_forms_index_headline'}
    {if $sSupport.sElements}
        {$smarty.block.parent}
    {elseif $sSupport.text2}
        {if $dvsnFormBackButtonArticleId > 0}
            <div class="forms--headline panel panel--body is--wide has--border is--rounded">
                {include file="frontend/_includes/messages.tpl" type="success" content=$sSupport.text2}
            </div>
            <div class="success-buttons buttons">
                <a href="{url controller="detail" action="index" sArticle=$dvsnFormBackButtonArticleId}" class="btn is--secondary left is--icon-left"><i class="icon--arrow-left"></i>{s name='back-to-article'}Zurück{/s}</a>
            </div>
        {else}
            {$smarty.block.parent}
        {/if}
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
