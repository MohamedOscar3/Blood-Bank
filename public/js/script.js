

$('.update').click(function() {
    console.log($(this).data('fields'));
    return setId('update',$(this).data('id'),$(this).data('model'),$(this).data('fields'));
});
    
$('.delete').click(function() {
    return setId('delete',$(this).data('id'),$(this).data('model'));
});

function setId(form_name,id,model,fields=false) {
    let formName = `#${form_name}`;
    let form = $(formName);
      
    let linkId = form.attr('action').split(`/${model}`);
        
    linkId[1] =  id;

    form.attr('action',linkId.join(`/${model}/`,linkId));
    
    if (fields) {
        
        setData(formName,fields);
    }
    
}


function setData(form_id,fields) {
    let inputs = fields.replace(/\s/g, "").split(',');
    
    
    for(let input in inputs) {
    
        input = inputs[input].split(":");
        
        $(form_id+` input[name="${input[0]}"]`).val(input[1]);
        
    }


   
}






$(function () {
    $('.selectpicker').selectpicker();
});


//open upload file on click

$('#upload_image').click(function (e) {
    e.preventDefault();

    $('#profile_upload').click();

    $('#profile_upload').change(function() {
        $('#upoload_photo_form').submit();
    });

}) 