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
        newDate.setDate(newDate.getDate() + 1);
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
    $.post("skyscanner/skyscanner/cityjson", function(data, status){
        var countries = data;

        $('#SearchForm_flyfrom').autocomplete({
            lookup: countries,
            onSelect: function (suggestion){
                $('#SearchForm_flyfromhid').val(suggestion.data);
            }
        });

        $('#SearchForm_flyto').autocomplete({
            lookup: countries,
            onSelect: function (suggestion){
                $('#SearchForm_flytohid').val(suggestion.data);
            }
        });

    });
    // ---------------- AUTOSUGGEST END
});
