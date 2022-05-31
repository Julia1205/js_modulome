<p style="text-align: center" class="my-2">
{if $customer.is_logged}
    {if isset ($lien)}
        Réalisez votre <a href="{$lien}">devis</a> gratuit de la maison de vos rêves ! 
        {else}
        Notre formulaire de devis est en maintenance
    {/if}
{else}
    <a href="{$urls.pages.authentication}">Connectez-vous </a> et faites, depuis chez vous, le devis de la maison de vos rêves !
{/if}
</p>