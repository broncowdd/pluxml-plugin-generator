<?php
/* 
pluxml plugin generator by bronco@warriodudimanche.net
license: do want you want with it ^^
http://warriordudimanche.net
*/
$version = 0.8;
if (!is_dir('temp')){mkdir('temp');}

// suppr les fichiers temp précédents
$temp=glob('temp/*.*');foreach ($temp as $file){unlink($file);}
function deep_strip_tags($var){if (is_string($var)){return strip_tags($var);}if (is_array($var)){return array_map('deep_strip_tags',$var);}return $var; }
function create_zip($source, $destination)
{
  if (!extension_loaded('zip') || !file_exists($source)) {
    return false;
  }

  $zip = new ZipArchive();
  if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
    return false;
  }

  $source = str_replace('', '/', realpath($source));

  if (is_dir($source) === true){
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($files as $file){
      $file = str_replace('', '/', $file);
      // Ignore "." and ".." folders
      if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
        continue;
      $file = realpath($file);
      if (is_dir($file) === true){
        $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
      }elseif (is_file($file) === true){
        $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
      }
    }
  }
  else if (is_file($source) === true){
    $zip->addFromString(basename($source), file_get_contents($source));
  }

  return $zip->close();
}


$hooks=explode(',','AdminThemesDisplayTop,AdminThemesDisplay,AdminThemesDisplayFoot,AdminArticleContent,AdminArticleFoot,AdminArticleInitData,AdminArticleParseData,AdminArticlePostData,AdminArticlePrepend,AdminArticlePreview,AdminArticleSidebar,AdminArticleTop,AdminAuthPrepend,AdminAuthEndHead,AdminAuthTop,AdminAuth,AdminAuthEndBody,AdminCategoryPrepend,AdminCategoryTop,AdminCategory,AdminCategoryFoot,AdminCategoriesPrepend,AdminCategoriesTop,AdminCategoriesFoot,AdminCommentTop,AdminComment,AdminCommentFoot,AdminCommentsPrepend,AdminCommentsTop,AdminCommentsPagination,AdminCommentsFoot	,AdminCommentNewPrepend,AdminCommentNewTop,AdminCommentNew,AdminCommentNewList,AdminCommentNewFoot	,AdminFootEndBody	,AdminIndexPrepend,AdminIndexTop,AdminIndexPagination,AdminIndexFoot	,AdminMediasPrepend,AdminMediasTop,AdminMediasFoot,AdminMediasUpload,AdminSettingsDisplayTop,AdminSettingsDisplay,AdminSettingsDisplayFoot,AdminSettingsAdvancedTop,AdminSettingsAdvanced,AdminSettingsAdvancedFoot,AdminSettingsBaseTop,AdminSettingsBase,AdminSettingsBaseFoot,AdminSettingsEdittplTop,AdminSettingsEdittpl,AdminSettingsEdittplFoot,AdminSettingsInfos,AdminSettingsPluginsTop,AdminSettingsPluginsFoot,AdminSettingsUsersTop,AdminSettingsUsersFoot,AdminPrepend,AdminProfilPrepend,AdminProfilTop,AdminProfil,AdminProfilFoot,AdminStaticPrepend,AdminStaticTop,AdminStatic,AdminStaticFoot,AdminStaticsPrepend,AdminStaticsTop,AdminStaticsFoot,AdminTopEndHead,AdminTopMenus,AdminTopBottom,AdminUserPrepend,AdminUserTop,AdminUser,AdminUserFoot,plxAdminConstruct,plxAdminDelArticle,plxAdminEditConfiguration,plxAdminHtaccess,plxAdminEditProfil ,plxAdminEditProfilXml,plxAdminEditUsersUpdate,plxAdminEditUsersXml,plxAdminEditUser,plxAdminEditCategoriesNew,plxAdminEditCategoriesUpdate,plxAdminEditCategoriesXml,plxAdminEditCategorie,plxAdminEditStatiquesUpdate,plxAdminEditStatiquesXml,plxAdminEditStatique,plxAdminEditArticle ,plxAdminEditArticleXml,plxFeedConstruct,plxFeedPreChauffageBegin ,plxFeedPreChauffageEnd,plxFeedDemarrageBegin ,plxFeedDemarrageEnd,plxFeedRssArticlesXml,plxFeedRssCommentsXml,plxFeedAdminCommentsXml,plxMotorConstruct,plxMotorPreChauffageBegin ,plxMotorPreChauffageEnd,plxMotorDemarrageBegin ,plxMotorDemarrageEnd,plxMotorDemarrageNewCommentaire,plxMotorDemarrageCommentSessionMessage,plxMotorGetCategories,plxMotorGetStatiques,plxMotorGetUsers,plxMotorParseArticle,plxMotorParseCommentaire,plxMotorNewCommentaire ,plxMotorAddCommentaire ,plxMotorAddCommentaireXml,plxMotorSendDownload ,plxShowConstruct,plxShowPageTitle ,plxShowMeta ,plxShowLastCatList ,plxShowArtTags ,plxShowArtFeed ,plxShowLastArtList ,plxShowComFeed ,plxShowLastComList ,plxShowStaticListBegin ,plxShowStaticListEnd ,plxShowStaticContent,plxShowStaticInclude ,plxShowPagination ,plxShowTagList ,plxShowArchList ,plxShowPageBlog ,plxShowTagFeed,plxShowTemplateCss ,plxShowCapchaQ ,plxShowCapchaR ,plxShowLastArtListContent,plxShowStaticContentBegin,Index,IndexBegin,IndexEnd,SitemapStatics,SitemapCategories,SitemapArticles,SitemapBegin,SitemapEnd,FeedBegin,FeedEnd,ThemeEndHead,ThemeEndBody');
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


'infos.xml'=>'<?xml version="1.0" encoding="UTF-8"?>
<document>
	<title><![CDATA[#NOMPLUGIN]]></title>
	<author><![CDATA[#AUTEUR]]></author>
	<version>#VERSION</version>
	<date>#DATE</date>
	<site>#SITE</site>
	<description><![CDATA[#DESCRIPTION]]></description>
</document>
',


'icon.png'=>'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4AkGBTIlUlTOUgAADI9JREFUeNrVm3uMXHd1xz+/3713Hjuz74d3vTu7XtvEsR2IH3Ebj7cNiiiRGqlAFQULAoSHgPwBpFIBCVWkqlRRpEr8A6lAqhAlQkAoSIjmDypTFY+vlFSptzIJsSM79o6z9r68npmdnZn7+vHHvbM7+5jZeW1xjnRl7frub37n/M75nu85vzOCFiWZnALANFMbfg5EAmPAaeA4cD+wDxgGeoFQ8F4JWAbmgOvA74GLgAncAtzygps/p/xzsyKa/cMzZ6ZQasuGBBAGjgFngceBgy3a+ArwEvBjYBqwANUuQ4hmT30bxfcAHwU+C9zH7sgbwPeAF4AlwKvcRzNGEC26uwBGgGeALwDd/P9IFvgW8DywaJopb7vDaasBNi+cTE51A08A/xic/h9DFoCvAP8O5JrxBtGEy0vgKPDPwPu5N+TXwBeBq6aZchoxgmhQ+Q7gr4DvAl3cW5IHPgG8ZJqpQr1G0BpQvh94Fvh2gPT3moSAJ4FSIjE+nU7PlNLpGZLJKdLpmcY9YJPyw8BzwOd5Z8i/Al82zdTyTi/KOpX/p3Ypr1TFs3sG+DTwfDI51bMNOasdAtu4/T8An8Hfr2hFcU1CLOwRC7lEDA8hBI4nUAqEaLsRHgD2JBLj50wzZVULBW0HwHsW+HKrrFEpiIYUx8byfOjBBT7w7nmS+zMMd7oUHEm2qON6YjeMcBzwEonxC6aZcrczwgYDJBLjBMAhgb8OAK8lcZWgM+LxsYdu89VHr3B0dJnR7jzjvSucnFzi0f3L3ClGeWspiuvtiif8OfBGOj1zaTsPkFWIztEg1bUW74HjPHb/HT5+agYhXbCD0sb1S6DOaJHPnb7OyUQOx5O7hQnfTSanjmyHB7Jc2FS4fndAclrO864n2NttczKRQegOeNu9BH09qxwayhM2/HDZBYkHoBgxzdQGI8hyjFZw+yfaxfCUgq6IRW+0tL3yZfEgbIChqd3MDI8E2WGjB5RdP7DKSMDt2yJCQKZgsJQPVUm46wa4nTVYteRuYEClfD2ZnBqq9AK5iRQ9087CRpOKW9kQr6R7KRX17Y2gw+XbfVyei+F6HrurP0NB8bS+xzJdDLo0/wZEGo918JRYe5QSa1nT82B+JUxXRHF4KLOFhypP8sKrY1x4qweBquoBqtVcvC6HE4nx75tmKl/pASJoZvQ0zuoEA3GPAwNF7hsqcmCwyFivRV/MoSMEYUMwnwuTequPW7n4Fp+bzcV5Yy5OtiDxlMD1fPB0PZ8k2a6g5EiUkoD/TovSHXg6yeQUIjj9CPB/jXRylIKIoTg1kePM/mXGuouEdIXjQq6ks5QPsZQ3yFkGtiuY6F3lkf0L7OlaXQdEAZaj8fNLY/zn5QHurBrYnkSg0DVFWPPoCLl0RRyGOi0iuuLl613MZkJ4zaOlAq4C95tmytWDXx5ruI0lBIf2rPLcY5fpiJXA2YQmlU8AdDhszAYKQrrL2ZMznN63zJuLcfKWjhSKqOHSGXboj1kkeoqEI0UIw7/8+j5evDhI0W6aOQpgAngvcK5sgLONur6hw2R/iY54CYotsiVXMdGXZWIgu24wVfGvF7RCgbtF3Q+D1iJBBDqf0wMceLzRP1cKio5sX0nnUZsrCMitRPjdbIySI5CipQ/WgUfLIDhGg61rAViuYCGn72pNu7lqSV0f4k5ep00fOpxMTh2S+JcWTbA8Ra4oya9G2e3kXWYs0ze7KNhau8iSBM7IoGRsKogKtmRmOeovpQEGoGm+g2ntt8HMcpiSI9plbw04puNfVzVBcxXZos5rt7s4vHeZSzd7+d2tLpZXDboiDsdH73J0eHkjoLUAWZ4dIlf0mydtsoAGHNLx7+oa9x8BKyWN/3h9gLmcwavpHl6fi7Fa8vnBe0b7+eSpGc4cmK+42WteVm0Dd5MhPeWTJgXoUiFFwyEwoQcUuDngVvDabJTpmzF06WFIh86wnyEupjsIa6MkeoqM92VrI3wdEtEdBGLNmYq2JB6Bff0FwprLtaUY2YJfUTYggzr+LW3TYmgKQ3O3VIEhzeP3c3FSb/XxkaHsWh5vlivooRJ7u22uzHdgu4LTk1ned98CB/pXMDSPdCbGT6dHeX023AhIxnTWr6jbC9oCMgVJ+m4EPEnLLuDC2RNv0xezGO4s8Wf7F3nXUMbHAwWHxzKM9RT52q8OsZCrG4F1fTczl+eB44r2oJYLD40tMtm3Ql/U8ttr7sb/P7L3Do8/sMQPXx7E9UTdQFBqhcVWK0rKneD+mA3SbY9FlaI/VkAId3uHcuAvD8+h1W9vR+JPZjQZ/9AZURTtrZ2OkiOZ6Cvx8L67LXv/Fsqsqp/IaNcKkfqDOi/xx1KayACCgZjNU6fmOb0/z4plULQllivIWxr9nR5PHLvNgyNLbUmD9YOPhxR1d5fndfyZnAebCYCSI+iKWHztfZf5r8lBLt7sJlOQjPbYPHJgkYcTiwip2usBm6vFTZJdjVK0vXpwxwNu6PgDSR9opuF5t2BwaTbOB0/e4MlYkffun6dkCzojLgOxIkK0WXlgpRQKOsjW1rVD8KvpEWy3Xljlso4/jdXUQdiuYC4XAkdiaA6jPU59sdpCEfvSpb28fKObJx+8zZ9Ozq2lQXQw3xzhxYt1ZwAHmNbxR9GaBGWFZStcS6DVk+q1IO9UdoncBgwl4GYmzivXu7m+GOHURD9HhleQQvH67S5euRFnLqvXS4QUcEHHn8O7QtOTXQIhNWoinQSU5LVbvbx6s4eFnI6hKd41WGBqcoHOjuLGllotG0qJIT3SyyEWV/pIXe1GAJmijuX4rfg65ZZppq7owc5fasYAQghCOkjDrk51NZjLxHjhfye4cK2TlZKG5UiEUHQYHr+4NMTTp26S3Ddf172YCAytawrbhaW85h8CyvfCOvM/cK7cGgJ/CPHZRkmQoSkGOh2o1p4SUCwZ/PK1YX42PYDnKaRQQQQICpbOYl7nW6v7ieguJ8YXd0yZGhYID5R/iySaq7c94Cdl5wR/AvONRhujsbDLwYF89diX8Hamg+m3u7Hs9ZJVBI8mFZpUXF0I8d/XBsiuhnfMXlFD0YY75DTI3wDI4FbYwp/AbMAAgu6wzYnR2kyv5AqKjkRWiU0BSKGYWY5yt2DUNoCCgZiFrrWUXlzgB6b5W5LJqTVjKvzx02wjPGBPl8ORkeXqbqugN2ozFLdqpiZPQcxwCGnejo57cDBPSPNaybA54Dtl88uKwYgl/PHTuty/I+RxeDgPtU7Dg5HuVY6O5JBS1ti0xnv2ZhnuLO54jX5kT4Z4uC6mVw26vmeaqTsApnl+Qzh5+LO3C/WsEtIUg3FrZ/wRiofH7/AnE1lK2xRNq5bkLw4vc2ZyCWQdtNFw6It7yOaAYAn4JqxPisjyXXngBYtsuj6u5v6rtuTaYmzn7q8HB4czfPj4LGN97oZQsFzBifECT5+6zmj/ykauXw0wlCBXlKjmKPbX108/tcbN1oaj0ukZlUiMXwUeAg7U2ofrwVwuhO1EODqSRwu5AaJVPBqslKKkro3wi0sjXJ0PIdbSoN81ypV00pk4s3fj3C12gNCIh5W/nrZxLccJ8XzqIP9zvRPbazgIzgNfSqdnvMppsbU1Nk2KHAJeBWL19AR7OjwODJaY7M3TFfURcTEf4vJ8jJklA8sBy5N4XvX2WTklasInNNGwoKfDpifqYWiCbEEwu6yTKUpst+H4zwPHTTP15ub54W1XSian9KBC/FkjPUAp1gcclPJH5ModI9EASpXfF2Jj9dvCANVZ00z9pPKgK1l6peIE8eEE9Pi5Rlrk5YEG262YAG0QryvfV8pf11MtKf8N4MXtlF/DgDV6VDFdnU7POInE+EX8uZoTvDPlR8DfmGbKqTY6vwXDNxmhlEiMn8cfKHjgHab8z4GnTTNVqvW9gW2zaeUYWTBy/gzw/XfYyT8FFHZCoJrhuWl4Og58Ffi7e1z5bwB/b5qpuu6iatKYcq4MDGElEuMXgqrxMXbpRqkFyQMfB75djvlEYqLmt0UayU6bveFIQJsfuUeUPw982jRTb1ZD+6Y8oAY4LiQS4z8GbgesMfZHUFoF3P5vgS+ZZmqxUeUb8oAa3lAeP/0U/hBimy4Da9bzuaB/8c0yt2/2K7RNb3Sbb5EOBdniqSBtioqWW6tSnjBMAz8AvlNWvJlTb4sBahhCwx9CPIs/ija8Xs6slTc79evcQGkVdK3P+T08+RvT/C3tULxtBqgWGhW/OwScwZ9GPRR4x2CAG3rFCeeBeeAGcDnoU14wzdSVrQYXmOb5tuz5D+Q3XMsb9CiPAAAAAElFTkSuQmCC',

'config.php'=>'<?php 
/**
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
#SETPARAM
		$plxPlugin->saveParams();
		header("Location: parametres_plugin.php?p=#NOMPLUGIN");
		exit;
	}
?>
<h2><?php $plxPlugin->lang("L_TITLE") ?></h2>
<p><?php $plxPlugin->lang("L_DESCRIPTION") ?></p>
<form action="parametres_plugin.php?p=#NOMPLUGIN" method="post" >
#PARAM
	<br />
	<input type="submit" name="submit" value="Enregistrer"/>
</form>
',


'lang/fr.php'=>'<?php 
	$LANG = array(
		"L_TITLE"=>"#NOMPLUGIN",
		"L_DESCRIPTION"=>"#DESCRIPTION",
		"L_NO"=>"Non",
		"L_YES"=>"Oui",
	);
',


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
	

	########################################
	# HOOKS
	########################################

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
 * PLX_PLUGINS
 * PLX_CONFIG_PATH
 * PLX_ADMIN (true si on est dans admin)
 * PLX_CHARSET
 * PLX_VERSION
 * PLX_FEED
 *
 * Appel de HOOK dans un thème
 *	eval($plxShow->callHook("ThemeEndHead","param1"))  ou eval($plxShow->callHook("ThemeEndHead",array("param1","param2")))
 *	ou $retour=$plxShow->callHook("ThemeEndHead","param1"));
 */

',
	);

if (!empty($_POST)){
	$post=array_map('deep_strip_tags',$_POST);
	$post['#DATE']=@date('d/m/y');
	$post['#ADMINACCESSCODE']='';
	$post['#CONFIGACCESSCODE']='';
	$post['#NOMPLUGIN']=preg_replace('#[^a-zA-Z0-9_]#','_',$post['#NOMPLUGIN']);
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
		if (isset($post['param'])){
			$post['#PARAM']='';
			$post['#SETPARAM']='';
			preg_match_all('#(?P<name>[^(]*?)\((?P<type>integer|boolean|string]*?)\)#i',$post['param'],$r);
			unset($post['param']);
			foreach ($r[0] as $key => $value) {
				$name=trim($r['name'][$key]);
				$type=trim($r['type'][$key]);
				$postname='$_POST["'.$name.'"]';
				if ($type=='string'){
					$input="\t<input type=\"text\" style=\"width:100%;\" name=\"$name\" value=\"<?php echo \$plxPlugin->getParam(\"$name\");?>\"/>";
				}elseif ($type=='integer'){
					$input="\t<input type=\"numeric\" style=\"width:100%;\" name=\"$name\" value=\"<?php echo \$plxPlugin->getParam(\"$name\");?>\"/>";
				}if ($type=='boolean'){
					$input="
					\t<select style=\"width:100%;\" name=\"$name\" value=\"<?php echo \$plxPlugin->getParam(\"$name\");?>\">
					<option value=\"0\" <?php \$plxPlugin->getParam(\"$name\")==\"0\" ? \"selected\":\"\"?>><?php echo \$plxPlugin->lang(\"L_NO\");?></option>
					<option value=\"1\" <?php \$plxPlugin->getParam(\"$name\")==\"1\" ? \"selected\":\"\"?>><?php echo \$plxPlugin->lang(\"L_YES\");?></option></select>";
				}
				$post['#PARAM'].="\t<li>\n\t\t<label>$name : \n\t\t$input\n\t\t</label>\n\t</li>\n";
				$post['#SETPARAM'].="\t\t\$plxPlugin->setParam(\"$name\", plxUtils::strCheck($postname), \"$type\");\n";
			}
			
		}
		
		
	
	}

	if (isset($post['fr_php'])){
		@mkdir('temp/'.$post['#NOMPLUGIN'].'/lang');
		$post['fr.php']='lang/fr.php';
	}
	if (!empty($post['img'])){
		@mkdir('temp/'.$post['#NOMPLUGIN'].'/img');
	}

	if (!empty($post['css'])){
		file_put_contents('temp/'.$post['#NOMPLUGIN'].'/style.css', '');
	}
	if (!empty($post['static'])){
		file_put_contents('temp/'.$post['#NOMPLUGIN'].'/static.php', '');
	}

	$hooks=array();
	if (!empty($post['hook'])){
		$hooks=$post['hook'];
		unset($post['hook']);
	}
	if (!empty($post['hooks'])){
		$hooks=array_merge($hooks,explode(' ',$post['hooks']));
		unset($post['hooks']);
	}
	
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
			$post['#FONCTIONSHOOKS'].="\n\t########################################\n\t# $hook\n\t########################################\n\t# Description:\n\tpublic function $hook(){\n\n\t}\n";
		}
	}



	foreach ($template as $file=>$content){
		if ($file!='icon.png'){
			$content=trim($content);				
			if (!empty($post[str_replace('.','_',basename($file))])){				
				file_put_contents($uploaddir.$file,str_replace(array_keys($post),array_values($post),$content));
			}
		}else{ 
			if (!is_file($uploaddir.$file)){file_put_contents($uploaddir.$file,base64_decode($content));}
		}
	}

	rename($uploaddir.'pluginfile.php',$uploaddir.$post['#NOMPLUGIN'].'.php');

	// creation du zip
	$filename='temp/'.$post['#NOMPLUGIN'].'.zip';
	$tozip=array(
		'temp/'.$post['#NOMPLUGIN'].'/lang/fr.php',
		'temp/'.$post['#NOMPLUGIN'].'/img/',
		'temp/'.$post['#NOMPLUGIN'].'/admin.php',
		'temp/'.$post['#NOMPLUGIN'].'/config.php',
		'temp/'.$post['#NOMPLUGIN'].'/icon.png',
		'temp/'.$post['#NOMPLUGIN'].'/infos.xml',
		'temp/'.$post['#NOMPLUGIN'].'/style.css',
		'temp/'.$post['#NOMPLUGIN'].'/static.php',
		'temp/'.$post['#NOMPLUGIN'].'/'.$post['#NOMPLUGIN'].'.php',
		);
	create_zip('temp/'.$post['#NOMPLUGIN'], $filename, true);
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
    <link rel="shortcut icon" type="image/png" href="data:image/png;base64,<?php echo $template['icon.png'];?>">
    <title>WDD plugin template generator</title>
    <!--[if IE]><script> document.createElement("article");document.createElement("aside");document.createElement("section");document.createElement("footer");</script> <![endif]-->
<style>
		*, *:before, *:after {   -webkit-box-sizing: border-box;    -moz-box-sizing: border-box;    box-sizing: border-box; }
		body{font-family: "Lucida Grande","Arial Unicode MS", sans-serif;padding:0;margin:0 auto;background-color:#eee;color:rgba(0,0,0,0.5);}
		section{padding-top:10px;padding-bottom:20px;max-width:960px;margin:auto;}

		header{text-align:center;min-height:128px;background:#3a3a3c;color:orange;padding-top:80px;font-size:30px;padding:10px;border-bottom:1px solid rgba(0,0,0,0.1);box-shadow: 0 0px 10px rgba(0,0,0,0.3);}
		footer{text-align:center;min-height:30px;background-color:#3a3a3c;color:orange;font-size:20px;padding:10px;border-radius:3px;}
		li{list-style:none;margin-bottom:10px;}
		h1{margin:0 0 25px 0 ;background:#3a3a3c;border-radius:1px ;padding:5px;color:orange;font-weight: normal;}
		textarea{min-height:100px;}
		fieldset{background:white;padding:0;border-radius:1px;box-shadow: 0 10px 20px rgba(0,0,0,0.5);margin:20px;border:1px solid #ddd;}
		fieldset div{padding:10px;}
		input[type=text],textarea{width:100%;border:none;border-bottom:2px solid rgba(0,0,0,0.3);padding:3px;font-size:18px;}
		textarea{resize:vertical;}
		input[type=text]:hover,textarea:hover{border-color:#eee;}
		input[type=text]:focus,textarea:focus{border:none;border-bottom:2px solid orange;outline: none;}
		input[type=submit],label{cursor:pointer;padding:10px;margin:5px;display:inline-block;}
		input[type=submit]:hover,label:hover{opacity:0.8;box-shadow: 0 1px 5px rgba(0,0,0,0.3)}
		input[type=submit],label{
			border-radius: 2px;
			border:none;
			background-color: #F80;
		    color: white;
		    opacity: 0.4;
		    text-shadow:0 2px 2px rgba(150,50,0,0.5);
		    display: inline-block;
		    margin: 5px;
		}
		input[type=submit]{font-size: 2em;display:block;margin:auto}
		#addhook{height:400px;overflow-y:scroll;text-align: justify;font-size: 0.8em}
		input[type=checkbox]{display:none;}
		input[type=checkbox]:checked+label{opacity:1;box-shadow: 0 3px 5px rgba(0,0,0,0.5)}
		input[type=checkbox]:checked+label+.onlyselected{display:block;}
		.onlyselected{display:none;}
		a,a:visited,a:active{color:white;text-decoration: none;font-weight: bold}
		form a{color:black;cursor:pointer;}
</style>

</head>

<body>
	<header><img src="data:image/png;base64,<?php echo $template["icon.png"];?>" alt="logo"/><p>WDD Générateur de plugin pour pluxml v<?php echo $version ?></p></header>
	<section>
		<form action="#" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
			<fieldset>
				<h1>&#10002; Informations</h1>
				<div>
					
					<li><h3>Nom du plug-in</h3><input type="text" name="#NOMPLUGIN"/></li>
					<li><h3>Version</h3><input type="text" value="1.0" name="#VERSION"/></li>
					<li><h3>Auteur</h3><input type="text" name="#AUTEUR"/></li>				
					<li><h3>Description</h3><textarea type="text" name="#DESCRIPTION"></textarea></li>
					<li><h3>Site web</h3><input type="text" name="#SITE"/></li>
					<li><h3>Icône</h3><input type="file" name="icon" value=""/></li>
				</div>
			</fieldset>
			<fieldset>
				<h1>&#8605; Hooks</h1>
				<div>
					<h3>Ajouter des hooks</h3>

						<div id="addhook" name="addhook"/>
							<?php
								natcasesort($hooks);
								foreach ($hooks as $key=>$hook){
									//echo '<option value="'.$hook.'">'.$hook.'</option>';
									echo '<input type="checkbox" value="'.$hook.'" name="hook[]" id="hook'.$key.'"><label for="hook'.$key.'">'.$hook.'</label>';
								}
							?>
						</div>
						<h4>Ajoutez les hooks standards ou tapez les vôtres directement ci-dessous</h4><br/>
					<textarea id="hooks" name="hooks"></textarea>
				</div>
			</fieldset>

			<fieldset>
				<h1>&#10004; Options</h1>
				<div>
					<li><input type="checkbox" name="config_php" id="cfg"/><label for="cfg">&#8853; Page de configuration</label><span class="onlyselected"><p>Paramètres</p><input type="text" name="param" placeholder="param1_name(string) param2_name(integer) param3_name(boolean)"/></span></li>
					<li><input type="checkbox" name="admin_php" id="adm"/><label for="adm">&#8853; Page d'administration</label></li>		
					<li><input type="checkbox" name="fr_php" id="lan"/><label for="lan">&#8853; Dossier langues</label></li>	
					<li><input type="checkbox" name="static" id="sta"/><label for="sta">&#8853; static.php</label></li>	
					<li><input type="checkbox" name="css" id="css"/><label for="css">&#8853; style.css</label></li>	
					<li><input type="checkbox" name="img" id="img"/><label for="img">&#8853; Dossier img/</label></li>	
				</div>	
			</fieldset>
			<input type="hidden" name="pluginfile_php" value="1"/>
			<input type="hidden" name="infos_xml" value="1"/>
			<input type="submit" value="&#8615; Créer le zip du plug-in"/>
		</form>
	</section>
<footer><a href="https://github.com/broncowdd/pluxml-plugin-generator">Github</a> - <a href="http://www.warriordudimanche.net/contact">Contact</a></footer>

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
