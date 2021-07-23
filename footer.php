		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap-table.min.js"></script>
		<script src="assets/js/all.js"></script>
		<script type="text/javascript">
			function triggerClick(e) {
				document.querySelector('#txtprofilepic').click();
			}
			function displayImage(e) {
				if (e.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e){
					document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
					}
					reader.readAsDataURL(e.files[0]);
				}
			}

			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#txtprofilepic')
							.attr('src', e.target.result)
							.width(150)
							.height(200);
					};

					reader.readAsDataURL(input.files[0]);
				}
			}
		</script>
	</body>
</html>