<?php
	session_start();
	include "../connection.php";
?>
<form action="update_password.php?user=<?php echo $_SESSION['username']; ?>" class="form-horizontal" method="post">
	<table class="table table-striped table-hover">
		<tbody>
			<tr>
				<td width="30%">
					<b>Nama</b>
				</td>
				<td>
					<?php echo $_SESSION['username']; ?>
				</td width="70%">
			</tr>
			<tr>
				<td>
					<b>Password Lama</b>
				</td>
				<td>
					<input type="password" class="col-lg-10" id="pass" name="pass" placeholder="Password Lama"/>
				</td>
			</tr>
			<tr>
				<td>
					<b>Password Baru</b>
				</td>
				<td>
					<p><input type="password" class="col-lg-10" id="pass1" name="pass1" placeholder="Password Baru"/></p><br />
					<p><input type="password" class="col-lg-10" id="pass2" name="pass2" placeholder="Ulangi Password Baru"/></p>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<button type="submit" class="btn btn-outline btn-primary btn-md">Simpan</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>