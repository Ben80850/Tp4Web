{extends file='layout.tpl'}
{block name=title}Accueil{/block}
{block name=body}
<div id='main'>

    {if isset($user)} // Si l'utilisateur est co on affiche son nom Sinon on lui dit de se co ou de creer un compte
        <h1>Home</h1>
        <p>Bienvenue ! {$smarty.session.user.nom}</p>

        <div>
            <a href='profil'>profil</a>
            <a href='logout'>Me déconnecter</a>
        </div>
    {else}
        <h1>Home</h1>
        <<p>Contenu du site </p>
        <div>
            <a href='register'>inscription</a>
            <a href='login'>connexion</a>
        </div>
    {/if}

</div>
{/block}