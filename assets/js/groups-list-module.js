/*
* Members List Module JavaScript
*/

(function($){

	var liItem = '#groups-list li .item-title';
	var viewportWidth = $(window).width();

	// Get the item-title max height to set all occurences to match
	var itemTitleHeight = $('#groups-list li .item-title').map(function() {
		return $(this).height();
	}).get();

	var itemTitleMaxHeight = Math.max.apply(null, itemTitleHeight) +30;

	var itemDescHeight = $('#groups-list li .item-desc').map(function() {
		return $(this).height();
	}).get();

	var itemDescMaxHeight = Math.max.apply(null, itemDescHeight);
	// Get the action buttons height to use to set current users display actions
	// if lacking in buttons.
	var actionButtons = $('#groups-list li .action ').map(function() {
		return $(this).height();
	}).get();

	var actionButtonMaxHeight = Math.max.apply(null, actionButtons);


	// Add an inner div to work any styling design on allows use of parents
	// padding property for spacing.
	$('#groups-list li').wrapInner('<div class="wrap">');

	// Set all list elements .item-title div to have equal min-height based on the highest &
	// add padding for empy action buttons container on current logged in user entry.

	// if(viewportWidth > '601') {
		// $( liItem ).css({'min-height': itemTitleMaxHeight + 'px' });
	// }

	$( '#groups-list li .action' ).css({'min-height': actionButtonMaxHeight + 'px', 'margin-bottom': '-2px' });

	$( '#groups-list li .item-desc' ).css({'min-height': itemDescMaxHeight + 'px', 'margin-bottom': '-2px' });

	if( $( '#groups-list li.is-current-user' ) ) {
		if( $( '#groups-list li.is-current-user .action' ).children().length === 0 ) {

		}
	}
	//alert(actionButtonMaxHeight);

	function newPage(e) {
		var liItem = '#groups-list li .item-title';
		var viewportWidth = $(window).width();

		// Get the item-title max height to set all occurences to match
		var itemTitleHeight = $('#groups-list li .item-title').map(function() {
			return $(this).height();
		}).get();

		var itemTitleMaxHeight = Math.max.apply(null, itemTitleHeight) + 30;

		var itemDescHeight = $('#groups-list li .item-desc').map(function() {
			return $(this).height();
		}).get();

		var itemDescMaxHeight = Math.max.apply(null, itemDescHeight);
		// Get the action buttons height to use to set current users display actions
		// if lacking in buttons.
		var actionButtons = $('#groups-list li .action ').map(function() {
			return $(this).height();
		}).get();

		var actionButtonMaxHeight = Math.max.apply(null, actionButtons);

		// Set all list elements .item-title div to have equal min-height based on the highest &
		// add padding for empy action buttons container on current logged in user entry.

		if(viewportWidth > '601') {
			$( liItem ).css({'min-height': itemTitleMaxHeight + 'px' });
		}

		$( '#groups-list li .action' ).css({'min-height': actionButtonMaxHeight + 'px', 'margin-bottom': '-2px' });

		$( '#groups-list li .item-desc' ).css({'min-height': itemDescMaxHeight + 'px', 'margin-bottom': '-2px' });

		if( $( '#groups-list li.is-current-user' ) ) {
			if( $( '#groups-list li.is-current-user .action' ).children().length === 0 ) {

			}
		}
		//alert(actionButtonMaxHeight);
	}
	
	var targetNode = document.getElementById('groups-dir-list');
	var config = { attributes: true, childList: true, subtree: true };

	var callback = function(mutationsList, observer) {

		if( mutationsList.length > 1 ) {
			return;
		}
		for(var mutation of mutationsList) {
			var targets = document.getElementsByClassName('action');
			for(var target of targets ) {
				height = target.style.minHeight;
				if ( height ) {
					return;
				}
			}
			if (mutation.type == 'attributes') {
				newPage();
			}

		}
	};
	
	var observer = new MutationObserver(callback);

	if ( targetNode != null ) {
		observer.observe(targetNode, config);
	}

	// var targetNode2 = document.getElementsById('groups-dir-list');
	// var config2 = { attributes: false, childList: true, subtree: true };

	// var callback2 = function(mutationsList, observer) {

		// if( mutationsList.length > 1 ) {
			// return;
		// }
		// console.log(mutationsList);
		// for(var mutation of mutationsList) {
			// if (mutation.type == 'attributes') {
				// let elementAdded = addedNodes.find( a => a.classList.contains('groups') );
				// if ( elementAdded ) {
					// newPage();
				// }
			// }

		// }
	// };
	
	// var observer2 = new MutationObserver(callback2);

	// if ( targetNode2 != null ) {
		// observer.observe(targetNode2, config2);
	// }



	
})(jQuery);
