<?php
//tmp file

if (!isset($_FILES['file']))
{
	echo 0;
	exit();
}

$file = $_FILES['file'];

$uploadDirectory = 'images';
$fileName = uniqid('document', true);
$target = $uploadDirectory . DIRECTORY_SEPARATOR . $fileName;

$result = null;

if (move_uploaded_file($file['tmp_name'], $target))
{
    $result = array('success'=> true);
    $result['uploadName'] = $fileName;
}
else
{
    $result = array('error'=> 'Upload failed');
}

echo ($target);
exit();