var projects = [],
    selectedProject;

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

function showConfirmSessionModal() {
    var sessionType = $('#session_type').val(),
        sessionDate = $('#session_date').val(),
        sessionNoShow = $('#session_noshow').is(':checked') ? 'No-show' : "",
        sessionStudent = $('#session_student_fullname').val(),
        sessionNewStudent = $('#session_student_id').val() === "",
        sessionPrice = $('#session_price').val();

    if (sessionDate !== "" && sessionStudent !== "" && selectedProject !== undefined) {
        $('#errors').html('');
        $('.modal-footer > #submit').removeAttr('disabled');
        $('#session-type').html(sessionType);
        $('#session-date').html(sessionDate);
        if (sessionNoShow) $('#session-noshow').html('No-show');
        $('#session-student').html(sessionStudent);
        if (sessionNewStudent) $('#new-student').html('Ce nouvel étudiant sera enregistré en même temps que la session.');
        $('#session-project').html(selectedProject.name);
        $('#session-price').html(sessionPrice + ' €');
    } else {
        $('#errors').html('Merci de renseigner les informations manquantes pour ajouter une session.');
        $('.modal-footer > #submit').attr('disabled', 'disabled');
        $('#session-type').html(sessionType);
        if (sessionDate === "") {
            $('#session-date').html('<i>date à compléter</i>');
        } else {
            $('#session-date').html(sessionDate);
        }
        if (sessionStudent === "") {
            $('#session-student').html('<i>Etudiant à compléter</i>');
        } else {
            $('#session-student').html(sessionStudent);
        }
        if (selectedProject === undefined) {
            $('#session-project').html('<i>Projet à renseigner</i>');
        } else {
            $('#session-project').html(selectedProject.name);
        }
    }
}



