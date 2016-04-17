(function( $ ) {
	'use strict';

  jQuery(document).ready(function($){

    // Populate columns select options
    function wrc_populate_columns(){
      // Grid value
      var wrc_grid = $('#wrc-grid').val();
      var options_html = '';
      options_html += '<option value="">' + WRC_OBJ.lang.select + '</option>';
      if( wrc_grid ){
        for( var i = 0; i < wrc_grid ; i++ ){
          var opt = i + 1.0;
          // Append option
          options_html += '<option value="' + opt + '">' + opt + '</option>';
        }
      }
      // Empty all select option at first
      $('#wrc-column-number').html('');
      // Append options html to select field
      $('#wrc-column-number').append( options_html );
      $('#wrc-column-mix-wrap').fadeOut();

    }// end function

    // Populate text fields according to number of columns
    function wrc_populate_text_fields_for_column(){

      // Column number
      var wrc_column_number = $('#wrc-column-number').val();

      var texts_html = '';
      if( wrc_column_number ){
        for( var i = 0; i < wrc_column_number ; i++ ){
          texts_html += '<input type="number" class="column-mix-item" maxlength="2" min="1" max="12" />';
        }
        $('#wrc-column-mix-wrap').slideDown();
      }
      else{
        // No value
        texts_html = '';
        $('#wrc-column-mix-wrap').slideUp();
      }
      // Inject html
      $('#wrc-column-mix').html( texts_html );

    } // end function

    // Validate column mix
    function wrc_validate_column_mix(){
      var output = false;

      // Grid value
      var wrc_grid = $('#wrc-grid').val();
      if ( ! wrc_grid ) {
        alert(WRC_OBJ.lang.please_select_grid);
        return output;
      }

      // Column number
      var wrc_column_number = $('#wrc-column-number').val();
      if ( ! wrc_column_number ) {
        alert(WRC_OBJ.lang.please_select_column);
        return output;
      }

      // Array of column mix
      var mix_array = new Array();

      $('.column-mix-item').each( function(index){
        var mix_value = $(this).val();
        if ( mix_value) {
          mix_array[mix_array.length] = mix_value;
        }
      }); //end each

      // check if all fields are filled
      if( mix_array.length != wrc_column_number ){
        alert(WRC_OBJ.lang.invalid_column_mix);
        return output;
      }
      // Check sum of column mix
      var mix_sum = 0;
      jQuery.each(mix_array, function(index, item) {
        mix_sum += item * 1.0;
      });
      if( mix_sum != wrc_grid ){
        alert(WRC_OBJ.lang.invalid_column_mix);
        return output;
      }
      output = true;
      return output;

    }

    // Trigger change of Grid field
    $('#wrc-grid').change(function(e){
      wrc_populate_columns();
    });

    // Trigger change of Column field
    $('#wrc-column-number').change(function(e){
      wrc_populate_text_fields_for_column();
    });


    // Trigger Submit button
    $('#wrc-submit').click(function(e){
      e.preventDefault();

      var is_valid = wrc_validate_column_mix();
      if( true === is_valid ){
        // Column mix is valid; now do shortcode stuff
        var shortcode = '';
        var wrc_grid = $('#wrc-grid').val();
        var wrc_column_number = $('#wrc-column-number').val();
        if( wrc_column_number ){

          // Array of column mix
          var mix_array = new Array();

          $('.column-mix-item').each( function(index){
            var mix_value = $(this).val();
            if ( mix_value) {
              mix_array[mix_array.length] = mix_value;
            }
          }); //end each

          for( var i =0; i < wrc_column_number; i++ ){

            shortcode += '[wrc_column';
            // Grid attribute
            if ( '' != wrc_grid) {
              shortcode += ' grid="' + wrc_grid + '"';
            }
            // Width attribute
            shortcode += ' width="' + mix_array[i] + '"';

            // Type attribute
            if ( 0 == i ) {
              shortcode += ' type="start"';
            }
            else if ( ( wrc_column_number - 1 ) == i ) {
              shortcode += ' type="end"';
            }

            shortcode += ']';
            shortcode += WRC_OBJ.lang.your_content;
            shortcode += '[/wrc_column]';

          }

        }

        // inserts the shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

        // closes Thickbox
        tb_remove();
      } //end if

    });
  });


})( jQuery );
