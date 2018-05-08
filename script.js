$( function() {
		function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
			$( "#log" ).attr( "scrollTop", 0 );
		}

		$.ajax({
			url: "resources/states.xml",
			dataType: "xml",
			success: function( xmlResponse ) {
				var data = $( "state", xmlResponse ).map(function() {
					return {
						value: $( "name", this ).text()
					};
				}).get();
				$( "#birds" ).autocomplete({
					source: data,
					minLength: 0,
					select: function( event, ui ) {

					}
				});
			}
		});
	} );
