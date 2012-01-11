<html>
	<head>
		<base href="http://{$smarty.server.SERVER_NAME}/" />
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<title>Kundenbestätigung</title>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#E1E2E3" >
		<STYLE>
		{literal}
			a { color:#FF6600; color:#FF6600; color:#FF6600; }
		{/literal}
		</STYLE>
		<table width="100%" cellpadding="10" cellspacing="0" class="backgroundTable" bgcolor="#E1E2E3" >
			<tr>
				<td valign="top" align="center">
					<table width="650" cellpadding="20" cellspacing="0" bgcolor="#FFFFFF">
						<tr>
							<td bgcolor="#FFFFFF" valign="top" style="font-size:12px;color:#000000;line-height:150%;font-family:trebuchet ms;padding:7px;">
								<table>
									<tr>
										<td>
											Sie haben ein Formular-Mail von {$smarty.server.SERVER_NAME} erhalten.
										</td>
									</tr>
									<tr>
										<td>
											<br /><br />
										</td>
									</tr>
									<tr>
										<td>
											<strong>Bezahlte Produkte</strong><br /><br />
										</td>
									</tr>
									<tr>
										<td>
											<table  width="634" cellpadding="0" cellspacing="0">
												<tr>
													<th align="left" width="534">
														Produkt
													</th>
													<th align="right" width="50">
														Anzahl
													</th>
													<th align="right" width="50">
														Preis
													</th>
												</tr>
												{foreach from=$PRODUCTS item=PRODUCT name=L}
												<tr>
													<td style="border-bottom: 1px solid #E1E2E3">{$PRODUCT.title}</td>
													<td align="right" style="border-bottom: 1px solid #E1E2E3">{$FORMVALUES.products[$PRODUCT.id]}</td>
													<td align="right" style="border-bottom: 1px solid #E1E2E3">{$PRODUCTSUM[$PRODUCT.id]|round0} {$DISPLAY.currency}</td>
												</tr>
												{/foreach}
												<tr>
													<td>
														<strong>Total</strong>
													</td>
													<td>
														&nbsp;
													</td>
													<td align="right">
														<strong>{$SUM} {$DISPLAY.currency}</strong>
													</td>
											</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<br /><br />
										</td>
									</tr>
									<tr>
										<td>
											<strong>Gratis Produkte</strong><br /><br />
										</td>
									</tr>
									<tr>
										<td>
											<table  width="634" cellpadding="0" cellspacing="0">
											<tr>
												<th align="left" width="534">
													Produkt
												</th>
												<th align="right" width="50">
													Anzahl
												</th>
												<th align="right" width="50">
													Preis
												</th>
											</tr>
											{foreach from=$PRODUCTS item=PRODUCT name=L}
											<tr>
												<td style="border-bottom: 1px solid #E1E2E3">{$PRODUCT.title}</td>
												<td align="right" style="border-bottom: 1px solid #E1E2E3">{$PRODUCT.freeproducts}</td>
												<td align="right" style="border-bottom: 1px solid #E1E2E3">0 {$DISPLAY.currency}</td>
											</tr>
											{/foreach}
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<br /><br />
										</td>
									</tr>
									<tr>
										<td>
											<strong>Adressdaten</strong><br /><br />
										</td>
									</tr>
									<tr>
										<td>
											<table  width="634" cellpadding="0" cellspacing="0">
												<tr>
													<td width="150">Name:</td>
													<td>{$FORMVALUES.address.name}</td>
												</tr>
												<tr>
													<td>Strasse / Nr.:</td>
													<td>{$FORMVALUES.address.streetnr}</td>
												</tr>
												<tr>
													<td>PLZ / Ort:</td>
													<td>{$FORMVALUES.address.zipcity}</td>
												</tr>
												<tr>
													<td>Land:</td>
													<td>{$FORMVALUES.address.country}</td>
												</tr>
												<tr>
													<td>E-Mail:</td>
													<td>{$FORMVALUES.address.email}</td>
												</tr>
												<tr>
													<td colspan="2"><br /><strong>Dental Depot</strong><br /><br /></td>
												</tr>
												<tr>
													<td>Name:</td>
													<td>{$FORMVALUES.address.depot_name}</td>
												</tr>
												<tr>
													<td>Ort:</td>
													<td>{$FORMVALUES.address.depot_city}</td>
												</tr>
											</table>
										</td>
									</tr>

								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>