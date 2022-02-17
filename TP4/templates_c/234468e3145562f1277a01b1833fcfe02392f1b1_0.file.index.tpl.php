<?php
/* Smarty version 3.1.34-dev-7, created on 2022-01-15 11:20:46
  from 'C:\laragon\www\tps\TP4\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_61e2ae0e089795_49507851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '234468e3145562f1277a01b1833fcfe02392f1b1' => 
    array (
      0 => 'C:\\laragon\\www\\tps\\TP4\\templates\\index.tpl',
      1 => 1639309887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e2ae0e089795_49507851 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_95198086861e2ae0dee2665_68418933', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_65841109261e2ae0dee6735_51290050', 'body');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'layout.tpl');
}
/* {block 'title'} */
class Block_95198086861e2ae0dee2665_68418933 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_95198086861e2ae0dee2665_68418933',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Accueil<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_65841109261e2ae0dee6735_51290050 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_65841109261e2ae0dee6735_51290050',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div id='main'>

    <?php if ((isset($_smarty_tpl->tpl_vars['user']->value))) {?> // Si l'utilisateur est co on affiche son nom Sinon on lui dit de se co ou de creer un compte
        <h1>Home</h1>
        <p>Bienvenue ! <?php echo $_SESSION['user']['nom'];?>
</p>

        <div>
            <a href='profil'>profil</a>
            <a href='logout'>Me déconnecter</a>
        </div>
    <?php } else { ?>
        <h1>Home</h1>
        <<p>Contenu du site </p>
        <div>
            <a href='register'>inscription</a>
            <a href='login'>connexion</a>
        </div>
    <?php }?>

</div>
<?php
}
}
/* {/block 'body'} */
}
