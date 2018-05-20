$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: ('+ 0d'),
        daysOfWeekDisabled: '0,2',
        datesDisabled: ['01/05/yyyy', '25/12/yyyy']
    });
});