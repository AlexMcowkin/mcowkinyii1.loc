$(document).ready(function(){

    var sitename = location.protocol + '//' + location.hostname;

    // ---------------- DATEPICKER START
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var departure = $('.datepickerD').datepicker({
      format:'yyyy-mm-dd',
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function(ev) {
      if (ev.date.valueOf() > arrival.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 7);
        arrival.setValue(newDate);
      }
      departure.hide();
      $('.datepickerA')[0].focus();
    }).data('datepicker');

    var arrival = $('.datepickerA').datepicker({
      format:'yyyy-mm-dd',
      onRender: function(date) {
        return date.valueOf() <= departure.date.valueOf() ? 'disabled' : '';
      }
    }).on('changeDate', function(ev) {
      arrival.hide();
    }).data('datepicker');
    // ---------------- DATEPICKER END

    // ---------------- AUTOSUGGEST START
    // https://www.devbridge.com/sourcery/components/jquery-autocomplete/
    $.post("skyscanner/skyscanner/cityjson", function(data, status){
        
        var countries = data;

        $('#SearchForm_flyfrom').autocomplete({
            lookup: countries,
            minChars: 3,
            maxHeight: 300,
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Please choose correct city!',
            onSelect: function (suggestion){
                $('#SearchForm_flyfromhid').val(suggestion.data);
                $('#SearchForm_flyfrom_em_').hide().text('');
                $('#submit-search').prop('disabled', false);
            },
            onInvalidateSelection: function (){
              $('#SearchForm_flyfrom_em_').show().text('please choose correct city');
              $('#submit-search').prop('disabled', true);
            }
        });

        $('#SearchForm_flyto').autocomplete({
            lookup: countries,
            minChars: 3,
            maxHeight: 300,
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'Please choose correct city!',
            onSelect: function (suggestion){
                $('#SearchForm_flytohid').val(suggestion.data);
                $('#SearchForm_flyto_em_').hide().text('');
                $('#submit-search').prop('disabled', false);
            },
            onInvalidateSelection: function (){
              $('#SearchForm_flyto_em_').show().text('please choose correct city');
              $('#submit-search').prop('disabled', true);
            }
        });

    });
    // ---------------- AUTOSUGGEST END
});
