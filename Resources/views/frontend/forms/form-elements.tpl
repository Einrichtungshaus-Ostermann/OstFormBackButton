
{* file to extend *}
{extends file="parent:frontend/forms/form-elements.tpl"}

{* set namespace *}
{namespace name="frontend/ost-form-back-button/forms/form-elements"}



{* ... *}
{block name="frontend_forms_form_elements_form_submit"}
    {if $dvsnFormBackButtonArticleId > 0}
        <div class="buttons">
            <a href="{url controller="detail" action="index" sArticle=$dvsnFormBackButtonArticleId}" class="btn is--secondary left is--icon-left"><i class="icon--arrow-left"></i>{s name='back-to-article'}Zurück{/s}</a>
            <button class="btn is--primary is--icon-right" type="submit" name="Submit" value="submit">{s namespace="frontend/forms/elements" name='SupportActionSubmit'}{/s}<i class="icon--arrow-right"></i></button>
        </div>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
