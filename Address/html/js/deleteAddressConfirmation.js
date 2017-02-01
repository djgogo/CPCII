$('.trash').click(function(){
    var id = $(this).data('id');
    $('#modalDelete').attr('href','/deleteaddress?id=' + id);
});
