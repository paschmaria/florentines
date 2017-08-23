( function( api ) {

	// Extends our custom "jgtforma-premium" section.
	api.sectionConstructor['jgtforma-premium'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
