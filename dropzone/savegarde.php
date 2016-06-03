$sql = "SELECT * FROM evenement_individuel ORDER BY id_event DESC";
$liste = $pdo->query($sql);
$data = $liste->fetch(); 
$chaine = $data['nom'];
setlocale(LC_ALL, 'fr_FR');
$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
while(strpos($chaine, '__') !== false)
{
  $chaine = str_replace('__', '_', $chaine);
}
$chaine = trim($chaine, '_');