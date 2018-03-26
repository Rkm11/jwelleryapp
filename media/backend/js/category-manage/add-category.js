// JavaScript Document
$(document).ready(function(e) {        
	$("#frm_add_category").validate({
		errorElement: "div",

		rules: {
			category_name:{
				required:true,
                                remote:{
					url: jQuery("#base_url").val()+"backend/category/check-category-name",
					type: "post"
				}
			},
                        category_description:{
                            required:true,
                            maxlength:200
                        },
                        category_type:{
                            required:true
                        }
			
		},
		messages:{
			category_name:{
				required:"Please enter category name.",
                                remote:"Category with the same name already exists."
			},
                        category_description:{
                            required:"Please enter category description.",
                            maxlength:"Description should not exceed 200 characters. "
                        },
                        category_type:{
                            required:"Please select category type."
                        }
			
		},
            submitHandler: function(form) {
                $("#btn_submit").hide();
                $("#loding_image").show();
                form.submit();
            }
	});
	
        jQuery.validator.addMethod("lettersonly", function(value, element) {
    	return this.optional(element) || /^[A-Z]+$/i.test(value);
	}, ""); 

        
	
        });