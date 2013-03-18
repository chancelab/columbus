/**
 * jQuery eComboBox - An editable Combo Box Plugin - http://www.reckdesign.de/eComboBox
 *
 * @author  Recep Karadas
 * @version 1.0
 *
 * jQuery eComboBox generates editable Combo Boxes.
 *
 * Licensed under The MIT License
 *
 * @version			1.0
 * @since			22.05.2011
 * @author			Recep Karadas
 * @documentation	http://www.reckdesign.de/eComboBox
 * @license			http://opensource.org/licenses/mit-license.php
 *
 * Usage with default values:
 * ---------------------------------------------------------------------------------
 * $('#eComboBox').eComboBox();
 *
 * <select id="eComboBox">
 * 	<option>Value 1</option>
 * 	<option>Value 2</option>
 * 	<option>Value 3</option>
 * 	<option>Value 4</option>
 * </select>
 *
 */

(function( $ ){

  var methods = {
     init : function( options ) {

		var settings = {
			'allowNewElements' : true,
			'editableElements' : true,
			'textBoxFocusColor': '#F1F1F1',
			'newItemText' : '{NEW ITEM}'
		};


		return this.each(function() {

			var wrapperElement = null;
			var selectElement = null;
			selectElement = $(this);
			var selected = "";
			// If options exist, lets merge them
			// with our default settings
			if ( options ) {
				$.extend( settings, options );
			}

			$(this).data("settings", settings);

			if (settings.allowNewElements){
				var culSelect = $(selectElement).val();
				selectElement.prepend('<option>' + settings.newItemText + '</option>');
				$(selectElement).val(culSelect);
			}

			// Create Wrapper Element
			var wrapperEl = document.createElement('span');
			wrapperElement = jQuery(wrapperEl);

			// Create Input Element
			var inputEl = document.createElement('input');
			var inputElement = jQuery(inputEl);

			// put input and select element in wrapper element
			selectElement.before(wrapperElement);
			wrapperElement.append(inputElement).append(selectElement);


			inputElement.css({
				"background": settings.textBoxFocusColor,
				"position" : "absolute",
				"display" : "none"
			});
			inputElement.attr('type', 'text');
			inputElement.attr('id', $(selectElement).attr('id') + 'text');
			inputElement.attr('name', 'data[eComboBox][' + $(selectElement).attr('id') + ']');


			resizeElements();

			selectElement.keydown( function(e){
				//alert(e.keyCode);
				if(e.keyCode >= 37 && e.keyCode <=40  || e.keyCode == 13) // arrow buttons or enter button
					return ;

				selected = $(this).val();

				if(e.keyCode == "46"){ // del-button
					if(selected != settings.newItemText){
						$(this).children("option:selected").remove();
					}
					return;
				}

				if( selected==settings.newItemText || settings['editableElements'] ) {
					inputElement.css({"display":"inline"});
					if(selected==settings.newItemText){
						inputElement.val( "" ).focus();
					}else if(settings['editableElements']){
						inputElement.val( $(this).val() ).focus();
					}
				}
			});

			selectElement.change( function(e){
				if($(this).val()==settings.newItemText){
					selected = $(this).val();
					inputElement.css({"display":"inline"});
					inputElement.val( "" ).focus();
				}
			});



			inputElement.keyup(function(e){
				if(e.keyCode == 13){ //enter
					if(selected==settings.newItemText ){
						if ($(this).val() != ""){
							selectElement.append('<option>'+$.trim($(this).val())+'</option>');
							selectElement.val($(this).val());
						}
					}else{
						if( $(this).val() == "" ) {
							selectElement.children('option:selected').remove();
						}else{
							selectElement.children('option:selected').text($(this).val());
						}
					}
					$(this).hide();
					selectElement.focus();
				}
				resizeElements();
			});


			function resizeElements(){
				wrapperElement.css({
					"width" : selectElement.outerWidth()
				});
				inputElement.css({
					"width" : selectElement.outerWidth()
				});
			 }


		}); // END RETURN
	 },
     destroy : function( ) {
		$(this).parent().remove();
	 },
	 disableAddingNewElements: function(){
		var fChild = $(this).children().first();
		if(fChild.text() == settings.newItemText){
			fChild.remove();
		}
	 },
	 enableAddingNewElements: function(){
		var fChild = $(this).children().first();
		if(fChild.text() != settings.newItemText){
			$(this).prepend('<option>' + settings.newItemText + '</option>');
		}
	 },
	 disableEditingElements: function(){
		$(this).data('settings').editableElements = false;
	 },
	 enableEditingElements: function(){
		$(this).data('settings').editableElements = true;
	 }
  };


  $.fn.eComboBox = function( method ) {

    if ( methods[method] ) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.eComboBox' );
    }

  };

})( jQuery );