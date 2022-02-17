<html>
<head>
    <title>{block name=title}Default Page Title{/block}</title>
    {block name=head}
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    <style>
    #main,footer{ padding:1em }
    </style>
    <link rel="stylesheet" href="templates/style.css">
    {/block}
</head>
<body>
{block name=menu}

    {if isset($user)} // Si l'utilisateur est co on affiche si il est connecté ou pas
        <p class="blockBleu">Connecté</p>
    {else}
        <p class="blockBleu">Non connecté</p>
    {/if}

<p>Menu de navigation générique défini dans layout.tpl</p>
<a href='./'>index</a>
<a href='register'>inscription</a> 
<a href='login'>connexion</a> 
<a href='profil'>profil</a> 

{/block}
{block name=body}Contenu générique{/block}

</body>
</html>
