function showDatePicker() {
    $('.input-group.date').datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            maxViewMode: 2,
            todayBtn: "linked",
            language: "fr",
            todayHighlight: true,
            autoclose: true
        }
    );
}

function getPrice() {
    if (($('#session_noshow').is(':checked'))) {
        $('#session_price').val(selectedProject.price / 2);
    } else {
        $('#session_price').val(selectedProject.price);
    }

}



