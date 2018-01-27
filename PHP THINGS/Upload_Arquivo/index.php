<html>
<head>
	<title>Upload de arquivo</title>
</head>
<body>
<form name="usr" enctype="multipart/form-data" method="post" action="upload.php">
	<table border="0" cellpadding="5" cellspacing="5">
		<tr>
		  <td height="30"><b>Arquivo:</b></td>
		  <td height="30" >
		  	<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<input type="FILE" name="ARQUIVO" size="50">
		  </td>
		</tr>
		<tr>
		  <td colspan=2 align>
			<input type="submit"  value=" Enviar o Arquivo">
		  </td>
		</tr>
	</table>
</form>
</body>
</html>
