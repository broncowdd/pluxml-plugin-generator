<?php
/* 
pluxml plugin generator by bronco@warriodudimanche.net
license: do want you want with it ^^
http://warriordudimanche.net
version: 0.5 
*/

if (!is_dir('temp')){mkdir('temp');}

// suppr les fichiers temp précédents
$temp=glob('temp/*.*');foreach ($temp as $file){unlink($file);}

function create_zip($files = array(),$destination = '',$overwrite = false) {  
	if(file_exists($destination) && !$overwrite) { return false; } 
    $valid_files = array();  
    if(is_array($files)) {  
        foreach($files as $file) {  
            if(file_exists($file)) {  
                $valid_files[] = $file;  
            }  
        }  
    }  
    if(count($valid_files)) {  
        $zip = new ZipArchive();  
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {  
            return false;  
        }  
        foreach($valid_files as $file) {  
            $zip->addFile($file,str_replace('temp/','',$file));  
        }  	        
        $zip->close();  	          
        return file_exists($destination);  
    }else{ return false; }  
}


$hooks=explode(',','AdminArticleContent,AdminArticleFoot,AdminArticleInitData,AdminArticleParseData,AdminArticlePostData,AdminArticlePrepend,AdminArticlePreview,AdminArticleSidebar,AdminArticleTop,AdminAuthPrepend,AdminAuthEndHead,AdminAuthTop,AdminAuth,AdminAuthEndBody,AdminCategoryPrepend,AdminCategoryTop,AdminCategory,AdminCategoryFoot,AdminCategoriesPrepend,AdminCategoriesTop,AdminCategoriesFoot,AdminCommentTop,AdminComment,AdminCommentFoot,AdminCommentsPrepend,AdminCommentsTop,AdminCommentsPagination,AdminCommentsFoot	,AdminCommentNewPrepend,AdminCommentNewTop,AdminCommentNew,AdminCommentNewList,AdminCommentNewFoot	,AdminFootEndBody	,AdminIndexPrepend,AdminIndexTop,AdminIndexPagination,AdminIndexFoot	,AdminMediasPrepend,AdminMediasTop,AdminMediasFoot,AdminMediasUpload,AdminSettingsDisplayTop,AdminSettingsDisplay,AdminSettingsDisplayFoot,AdminSettingsAdvancedTop,AdminSettingsAdvanced,AdminSettingsAdvancedFoot,AdminSettingsBaseTop,AdminSettingsBase,AdminSettingsBaseFoot,AdminSettingsEdittplTop,AdminSettingsEdittpl,AdminSettingsEdittplFoot,AdminSettingsInfos,AdminSettingsPluginsTop,AdminSettingsPluginsFoot,AdminSettingsUsersTop,AdminSettingsUsersFoot,AdminPrepend,AdminProfilPrepend,AdminProfilTop,AdminProfil,AdminProfilFoot,AdminStaticPrepend,AdminStaticTop,AdminStatic,AdminStaticFoot,AdminStaticsPrepend,AdminStaticsTop,AdminStaticsFoot,AdminTopEndHead,AdminTopMenus,AdminTopBottom,AdminUserPrepend,AdminUserTop,AdminUser,AdminUserFoot,plxAdminConstruct,plxAdminEditConfiguration,plxAdminHtaccess,plxAdminEditProfil ,plxAdminEditProfilXml,plxAdminEditUsersUpdate,plxAdminEditUsersXml,plxAdminEditUser,plxAdminEditCategoriesNew,plxAdminEditCategoriesUpdate,plxAdminEditCategoriesXml,plxAdminEditCategorie,plxAdminEditStatiquesUpdate,plxAdminEditStatiquesXml,plxAdminEditStatique,plxAdminEditArticle ,plxAdminEditArticleXml,plxFeedConstruct,plxFeedPreChauffageBegin ,plxFeedPreChauffageEnd,plxFeedDemarrageBegin ,plxFeedDemarrageEnd,plxFeedRssArticlesXml,plxFeedRssCommentsXml,plxFeedAdminCommentsXml,plxMotorConstruct,plxMotorPreChauffageBegin ,plxMotorPreChauffageEnd,plxMotorDemarrageBegin ,plxMotorDemarrageEnd,plxMotorDemarrageNewCommentaire,plxMotorDemarrageCommentSessionMessage,plxMotorGetCategories,plxMotorGetStatiques,plxMotorGetUsers,plxMotorParseArticle,plxMotorParseCommentaire,plxMotorNewCommentaire ,plxMotorAddCommentaire ,plxMotorAddCommentaireXml,plxMotorSendDownload ,plxShowConstruct,plxShowPageTitle ,plxShowMeta ,plxShowLastCatList ,plxShowArtTags ,plxShowArtFeed ,plxShowLastArtList ,plxShowComFeed ,plxShowLastComList ,plxShowStaticListBegin ,plxShowStaticListEnd ,plxShowStaticContent,plxShowStaticInclude ,plxShowPagination ,plxShowTagList ,plxShowArchList ,plxShowPageBlog ,plxShowTagFeed,plxShowTemplateCss ,plxShowCapchaQ ,plxShowCapchaR ,Index,IndexBegin,IndexEnd,SitemapStatics,SitemapCategories,SitemapArticles,SitemapBegin,SitemapEnd,FeedBegin,FeedEnd,ThemeEndHead,ThemeEndBody');
$template=array(
'admin.php'=>"<?php 
/**
* Plugin #NOMPLUGIN - Administration
*
* @package	PLX
* @version	#VERSION
* @date	#DATE
* @author #AUTEUR
**/
if(!defined('PLX_ROOT')) exit; ?>
<h1>Page d'administration de #NOMPLUGIN</h1>",


'infos.xml'=>'<?xml version="#VERSION" encoding="UTF-8"?>
<document>
<title><![CDATA[#NOMPLUGIN]]></title>
<author><![CDATA[#AUTEUR]]></author>
<version>1.0</version>
<date>#DATE</date>
<site>#SITE</site>
<description><![CDATA[#DESCRIPTION]]></description>
</document>
',


'icon.png'=>'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',


'config.php'=>'<?php /**
* Plugin #NOMPLUGIN - config page
*
* @package	PLX
* @version	#VERSION
* @date	#DATE
* @author #AUTEUR
**/
if(!defined("PLX_ROOT")) exit; ?>
<?php 
	if(!empty($_POST)) {
		$plxPlugin->setParam("param1", plxUtils::strCheck($_POST["param1"]), "string");
		$plxPlugin->setParam("param2", plxUtils::strCheck($_POST["param2"]), "string");
		$plxPlugin->saveParams();
		header("Location: parametres_plugin.php?p=#NOMPLUGIN");
		exit;
	}
?>
<h2><?php $plxPlugin->lang("L_TITLE") ?></h2>
<p><?php $plxPlugin->lang("L_DESCRIPTION") ?></p>
<form action="parametres_plugin.php?p=#NOMPLUGIN" method="post" style="font-size:16px;">
	<li><label>DESCRIPTION PARAMETRE 1 : 	<textarea style="width:100%;height:100px;" name="param1"><?php  echo $plxPlugin->getParam("param1"); ?></textarea></label></li>
	<li><label>DESCRIPTION PARAMETRE 2 : 	<textarea style="width:100%;height:100px;" name="param2" ><?php echo $plxPlugin->getParam("param2") ?></textarea></label></li>
	<br />
	<input type="submit" name="submit" value="Enregistrer"/>
</form>
',


'lang/fr.php'=>'
<?php 
	$LANG = array(
		"L_TITLE"=>"#NOMPLUGIN",
		"L_DESCRIPTION"=>"#DESCRIPTION"
	);
?>',


'pluginfile.php'=>'<?php
/**
* Plugin #NOMPLUGIN
*
* @package	PLX
* @version	#VERSION
* @date	#DATE
* @author #AUTEUR
**/
class #NOMPLUGIN extends plxPlugin {
	public function __construct($default_lang) {
		# appel du constructeur de la classe plxPlugin (obligatoire)
		parent::__construct($default_lang);

		#ADMINACCESSCODE
		#CONFIGACCESSCODE
		
		# Declaration d\'un hook (existant ou nouveau)
#DECLARATIONHOOKS
		
	}

	# Activation / desactivation
	public function OnActivate() {
		# code à executer à l’activation du plugin
	}
	public function OnDeactivate() {
		# code à executer à la désactivation du plugin
	}
	
	# HOOKS
#FONCTIONSHOOKS
	

}





/* Pense-bete:
 * Récuperer des parametres du fichier parameters.xml
 *	$this->getParam("<nom du parametre>")
 *	$this-> setParam ("param1", 12345, "numeric")
 *	$this->saveParams()
 *
 *	plxUtils::strCheck($string) : sanitize string
 *
 * 
 * Quelques constantes utiles: 
 * PLX_CORE
 * PLX_ROOT
 * PLX_CHARSET
 * PLX_CONFIG_PATH
 * PLX_PLUGINS
 * PLX_CONFIG_PATH
 * PLX_ADMIN (ture si on est dans admin)
 * PLX_CHARSET
 *
 * Appel de HOOK
 *	eval($plxShow->callHook("ThemeEndHead","param1"))  ou eval($plxShow->callHook("ThemeEndHead",array("param1","param2")))
 *	ou $retour=$plxShow->callHook("ThemeEndHead","param1"));
 */
?>
',
	);

if (!empty($_POST)){
	$post=array_map('strip_tags',$_POST);
	$post['#DATE']=@date('d/m/y');
	$post['#ADMINACCESSCODE']='';
	$post['#CONFIGACCESSCODE']='';
	@mkdir('temp/'.$post['#NOMPLUGIN']);
	if (isset($post['admin_php'])){
		$post['#ADMINACCESSCODE']='
		# limite l\'acces a l\'ecran d\'administration du plugin
		# PROFIL_ADMIN , PROFIL_MANAGER , PROFIL_MODERATOR , PROFIL_EDITOR , PROFIL_WRITER
		$this->setAdminProfil(PROFIL_ADMIN);
		';
	}
	if (isset($post['config_php'])){
		$post['#CONFIGACCESSCODE']='
		# limite l\'acces a l\'ecran de configuration du plugin
		# PROFIL_ADMIN , PROFIL_MANAGER , PROFIL_MODERATOR , PROFIL_EDITOR , PROFIL_WRITER
		$this->setConfigProfil(PROFIL_ADMIN);
		';
	}


	if (isset($_POST['fr_php'])){
		@mkdir('temp/'.$post['#NOMPLUGIN'].'/lang');
		$_POST['fr.php']='lang/'.$_POST['fr.php'];
	}

	$hooks=explode(' ',$post['hooks']);
	unset($post['hooks']);
	$post['#DECLARATIONHOOKS']='';
	$post['#FONCTIONSHOOKS']='';
	/*# limite l\'acces a l\'ecran d\'administration du plugin
		# PROFIL_ADMIN , PROFIL_MANAGER , PROFIL_MODERATOR , PROFIL_EDITOR , PROFIL_WRITER
		$this->setConfigProfil(PROFIL_ADMIN);
		$this->setAdminProfil(PROFIL_ADMIN);*/
	$uploaddir = 'temp/'.$post['#NOMPLUGIN'].'/';
	$uploadfile = $uploaddir . 'icon.png';
	
	if (preg_match('#.+\.png#i',$_FILES['icon']['name'])){move_uploaded_file($_FILES['icon']['tmp_name'], $uploadfile);}
	
	foreach ($hooks as $hook){
		if (!empty($hook)){
			$post['#DECLARATIONHOOKS'].="\t\t\$this->addHook('$hook','$hook');\n";
			$post['#FONCTIONSHOOKS'].="\tpublic function $hook(){\n\n\t}\n";
		}
	}
	foreach ($template as $file=>$content){
		if ($file!='icon.png'){
			echo '<li>';
			var_dump($file);
			var_dump($_POST[str_replace('.','_',basename($file))]);
			if (!empty($_POST[str_replace('.','_',basename($file))])){
				echo 'YES ';
				var_dump(file_put_contents($uploaddir.$file,str_replace(array_keys($post),array_values($post),$content)));
			}else echo 'no !';
			echo '</li>';
		}else{ 
			if (!is_file($uploaddir.$file)){file_put_contents($uploaddir.$file,base64_decode($content));}
		}
	}

	rename($uploaddir.'pluginfile.php',$uploaddir.$post['#NOMPLUGIN'].'.php');

	// creation du zip
	$filename='temp/'.$post['#NOMPLUGIN'].'.zip';
	$tozip=array(
		'temp/'.$post['#NOMPLUGIN'].'/lang/fr.php',
		'temp/'.$post['#NOMPLUGIN'].'/admin.php',
		'temp/'.$post['#NOMPLUGIN'].'/config.php',
		'temp/'.$post['#NOMPLUGIN'].'/icon.png',
		'temp/'.$post['#NOMPLUGIN'].'/infos.xml',
		'temp/'.$post['#NOMPLUGIN'].'/'.$post['#NOMPLUGIN'].'.php',
		);
	create_zip($tozip, $filename, true); 
	foreach ($tozip as $file){@unlink($file);}
	rmdir('temp/'.$post['#NOMPLUGIN'].'/lang');

	header('location: temp/'.$post['#NOMPLUGIN'].'.zip');

}else{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" charset="UTF-8">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="UTF-8">
    <title>WDD plugin template generator</title>
    <!--[if IE]><script> document.createElement("article");document.createElement("aside");document.createElement("section");document.createElement("footer");</script> <![endif]-->
<style>
*, *:before, *:after {   -webkit-box-sizing: border-box;    -moz-box-sizing: border-box;    box-sizing: border-box; }
body{padding:0;margin:0 auto;max-width:960px;background-color:#eee;}
section{padding-top:10px;padding-bottom:20px;}
header{text-align:center;min-height:50px;background-color:#333;color:#eee;font-size:30px;padding:10px;border-radius:3px;}
footer{text-align:center;min-height:30px;background-color:#333;color:#eee;font-size:20px;padding:10px;border-radius:3px;}
li{list-style:none;margin-bottom:10px;}
label{display:block;font-size:24px;}
h1{margin:0 0 25px 0 ;background:rgba(0,0,0,0.2);border-radius:3px;padding:5px;}
textarea{min-height:100px;}
fieldset{border-radius:3px;box-shadow: 0 1px 2px;margin:20px;border:none;border-top:1px solid #ddd;}
input,textarea{border-radius:3px;width:100%;border:1px solid rgba(0,0,0,0.3);padding:3px;font-size:18px;box-shadow: inset 0 1px 1px rgba(0,0,0,0.5)}
textarea{resize:vertical;}
input[type=text]:hover,textarea:hover{background-color:#eee;}
input[type=text]:focus,textarea:focus{background-color:#ddd;}
input[type=checkbox]{display:inline;width:auto;cursor: pointer}
input[type=submit]{
	background-color:#555;color:#ddd;cursor:pointer;
	margin:20px;padding:10px;box-shadow: 0 1px 2px rgba(0,0,0,0.5); 
	border-top:1px solid #ccc;
	border-bottom:1px solid #444;
}
a,a:visited,a:active{color:white;text-decoration: none;font-weight: bold}
form a{color:black;cursor:pointer;}
</style>

</head>

<body>
	<header>WDD pluxml plugin template generator v0.5</header>
	<section>
		<form action="#" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
			<fieldset><h1>Informations</h1>
				<li><label>Nom du plug-in</label><input type="text" name="#NOMPLUGIN"/></li>
				<li><label>Version</label><input type="text" value="1.0" name="#VERSION"/></li>
				<li><label>Auteur</label><input type="text" name="#AUTEUR"/></li>				
				<li><label>Description</label><textarea type="text" name="#DESCRIPTION"></textarea></li>
				<li><label>Site web</label><input type="text" name="#SITE"/></li>
				<li><label>Icône</label><input type="file" name="icon" value=""/></li>
			</fieldset>
			<fieldset><h1>Hooks</h1>
				<li><label>Ajouter des hooks</label>

					<select id="addhook" name="addhook" value=''/>
						<?php
							foreach ($hooks as $hook){
								echo '<option value="'.$hook.'">'.$hook.'</option>';
							}
						?>
					</select>
					<a  onClick="hook()">Ajouter</a>
				</li><small>Ajoutez les hooks standards par le bouton ajouter ou tapez les vôtres directement ci-dessous</small><br/>
				<li><textarea id="hooks" name="hooks"></textarea> </li>
			</fieldset>

			<fieldset><h1>Options</h1>
				<li><label><input type="checkbox" name="config_php"/> Page de configuration</label></li>
				<li><label><input type="checkbox" name="admin_php"/> Page d'administration</label></li>		
				<li><label><input type="checkbox" name="fr_php"/> Dossier langues</label></li>		
			</fieldset>
			<input type="hidden" name="pluginfile_php" value="1"/>
			<input type="hidden" name="infos_xml" value="1"/>
			<input type="submit" value="Créer le zip du plug-in"/>
		</form>
	</section>
<footer>Get this opensource generator on <a href="https://github.com/broncowdd/pluxml-plugin-generator">Github</a> - <a href="">Warriordudimanche</a></footer>

<script>
function hook(){ 
	var selectElmt = document.getElementById('addhook');
	hooktoadd=selectElmt.options[selectElmt.selectedIndex].value;
	txt=document.getElementById('hooks');
	txt.value+=' '+hooktoadd;
}
</script>
</body>
</html>


<?php } ?>
