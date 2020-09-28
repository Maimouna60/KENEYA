$('#deletePatientModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('iduser')
    $('#recipient-name').val(id);
  });

  
$('#deleteDoctorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('iduser')
  $('#recipient-name').val(id);
});