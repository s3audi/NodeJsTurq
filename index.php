<?php
if ($_POST['submit'])
{
copy($_FILES['file']['tmp_name'], $_FILES['file']['name']);
}
?>
<html>
<head><title>Page Links</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
$dir=opendir(".");
$files=array();
while (($file=readdir($dir)) !== false)
{
if ($file != "." and $file != ".." and $file != "index.php")
{
array_push($files, $file);
}
}
closedir($dir);
sort($files);

?>

<?php
function file_get_contents_curl($url)
{
 $ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$data = curl_exec($ch);
 curl_close($ch);

return $data;
}
foreach ($files as $file){
$html = file_get_contents_curl("http://www.urlforyourfolderhere.com/$file");

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

$metas = $doc->getElementsByTagName('meta');

if ($title !="403 Forbidden"){
echo "<a href='$file'>$title</a>". '<br/><br/>';}

}
?>

</body>
</html>