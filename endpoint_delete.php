<?php
//tmp file
if (isset($_POST['filename']) && isset($_POST['filepath']))
{
	$file = $_POST['filename'];

	$uploadDirectory = $_POST['filepath'];

	if (!empty($uploadDirectory))
	{
		$target = $uploadDirectory . DIRECTORY_SEPARATOR . $file;
	}
	else
	{
		$target = $file;
	}

	$result = unlink($target);

	echo json_encode($result);
	exit();
}
else if (isset($_POST['filename']))
{
	$file = $_POST['filename'];

	$uploadDirectory = 'images';
	$target = $uploadDirectory . DIRECTORY_SEPARATOR . $file;

	$result = unlink($target);

	echo json_encode($result);
	exit();
}

echo 0;
exit();