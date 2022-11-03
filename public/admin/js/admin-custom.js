var hostname = $(location).attr('origin') + "/lay-buys/";

var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    //console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

function validatePrice(e) {
	var val = e.value;
	var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
	var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
	
	val = re1.exec(val);
	if (val) {
		e.value = val[0];
	} else {
		e.value = "";
	}
}


$(document).ready(function() {
	$(".add").click(function(){
		var total_element = $(".element").length;
		var lastid = $(".element:last").attr("id");
		var split_id = lastid.split("_");
		var nextindex = Number(split_id[1]) + 1;
		var max = $('#pip_count').val();
		if(total_element < max ){
			var validate = $('#insta_period_'+total_element).val();
			if(validate == ''){
				$("#insta_period_"+total_element).focus();
				$("#insta_period_"+total_element).addClass('error'); return false;
			}else{
				$("#insta_period_"+total_element).removeClass('error');
			}
			$(".element:last").after("<div class='form-group col-md-6 element clearfix' id='div_"+ nextindex +"'></div>");
			$("#div_" + nextindex).append("<div class='col-md-9' style='padding:0px;'><input name='insta_period[]' type='text' class='form-control' id='insta_period_"+ nextindex +"' onKeyUp='validatePrice(this)' maxlength='4'></div><div class='col-md-2 weeks'>Weeks</div><div class='col-md-1 text-right'><a href='javascript:void(0);' id='remove_" + nextindex + "' class='remove'><i class='fa fa-times'></i></a></div>");        
		}
	});
    
	$('.container').on('click','.remove',function(){
		var id = this.id;
		var split_id = id.split("_");
		var deleteindex = split_id[1];
		$("#div_" + deleteindex).remove();
	}); 
	
	$(".addfile").click(function(){
		var total_element = $(".fileelement").length;
		var lastid = $(".fileelement:last").attr("id");
		var split_id = lastid.split("_");
		var nextindex = Number(split_id[1]) + 1;
		var max = $("#prd_photo_count").val();
		if(total_element < max ){
			$(".fileelement:last").after("<div class='form-group col-md-8 fileelement' id='file_"+ nextindex +"'></div>");
			$("#file_" + nextindex).append("<div class='col-md-5' style='padding:0px;'><input name='product_photo[]' type='file' class='btn' id='txt_"+ nextindex +"'></div><div class='col-md-1 text-right'><a href='javascript:void(0);' id='removefile_" + nextindex + "' class='removefile'><i class='fa fa-times'></i></a></div>");        
		}
	});
	$('.container').on('click','.removefile',function(){
		var id = this.id;
		var split_id = id.split("_");
		var deleteindex = split_id[1];
		$("#file_" + deleteindex).remove();
	});
});

function select_category(id) {
    $.ajax({
        type: "POST",
        url: hostname + "findsubcategory",
        data: 'id=' + id,
        dataType: "JSON",
        beforeSend: function() {
            $("#loading").css('display', 'block');
        },
        success: function(data) {
            if (data != 0) {
                setTimeout(function() {
                    $("#loading").css('display', 'none');
                }, 500);
                var _data = data.data_subcategory;
                if (_data != "") {
                    $('#prd_sub_cat_id').empty().append('<option value="">Select Subcategory...</option>');
                    $.each(_data, function(key, val) {
                        $('#prd_sub_cat_id').append($("<option/>", {
                            value: val.sub_cat_id,
                            text: val.sub_cat_name
                        }));
                    });
                } else {
                    $('#prd_sub_cat_id').empty().append('<option value="">Select Subcategory...</option>');
                }
                $("#__subcategoty").fadeIn();
            } else {
                setTimeout(function() {
                    $("#loading").css('display', 'none');
                }, 500);
            }

        }
    })
}

function removePrdimg(id){
	var confi = confirm('Are you sure you want to delete this record ?');
	if(id != "" && confi){
		$.ajax({
        type: "POST",
        url: hostname + "removePrdImg",
        data: 'id=' + id,
        success: function(data) {
            if (data != 0) {
                $(".prdImg"+id).fadeOut("slow");
            } else {
                alert("some has error");
            }

        }
    })
	}
}

function removepip(id){
	var confi = confirm('Are you sure you want to delete this record ?');
	if(id != "" && confi){
		$.ajax({
        type: "POST",
        url: hostname + "removePip",
        data: 'id=' + id,
        success: function(data) {
            if (data != 0) {
                $(".pip"+id).fadeOut("slow");
            } else {
                alert("some has error");
            }

        }
    })
	}
}

/**********Deactived Status**************/
function Active_Status(id) {
    var confi = confirm('Are you sure you want to deactivte  this product?');
    if (confi) {
        $.ajax({
            type: "POST",
            url: hostname + "prdActive_Status",
            data: 'prdId=' + id,
            beforeSend: function() {
                $("#load").css('display', 'block');
            },
            success: function(data) {
                if (data == '1') {
                    $("#Active_" + id).removeClass("active_Status");
                    $("#Active_" + id).addClass("deactive_Status");
                    $("#Active_" + id).html("<i class='fa fa-lock'></i>");
                    $("#Active_" + id).attr("onclick", "return Deactive_Status(" + id + ")");
                    $("#Active_" + id).attr("title", "Inactive");
                    $("#Active_" + id).attr("id", "Deactive_" + id + "");
                    $("#load").css('display', 'none');
                } else {
                    $("#load").css('display', 'none');
                }
            }
        });
    }
}
/**********Actived Status Student**************/
function Deactive_Status(id) {
    var confi = confirm('Are you sure you want to activate  this product?');
    if (confi) {
        $.ajax({
            type: "POST",
            url: hostname + "prdDeactive_Status",
            data: 'prdId=' + id,
            beforeSend: function() {
                $("#load").css('display', 'block');
            },
            success: function(data) {
                if (data == '1') {
                    $("#Deactive_" + id).removeClass("deactive_Status");
                    $("#Deactive_" + id).addClass("active_Status");
                    $("#Deactive_" + id).html("<i class='fa fa-unlock'></i>");
                    $("#Deactive_" + id).attr("onclick", "return Active_Status(" + id + ")");
                    $("#Active_" + id).attr("title", "Activate");
                    $("#Deactive_" + id).attr("id", "Active_" + id + "");
                    $("#load").css('display', 'none');
                } else {
                    $("#load").css('display', 'none');
                }
            }
        });
    }
}




function validateAdminLogin(){
  if($('#cr_adm').val() =='0'){
	  $('#cap_error_adm').html('This field is required.');
	  return false;
  }else{
	  return true;
  }
}

function captchaCallbackAdmin(response) {
	$('#cr_adm').val(response);
}