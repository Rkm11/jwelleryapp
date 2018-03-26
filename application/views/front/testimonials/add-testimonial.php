<body>
 <div id="container" class="container">
          
            <section>                
                <div class="panel-group">  
                    <div class="col-xs-12 col-md-5 panel panel-default">
                        <div class="col-lg-12">
                            <h1 id="buttons">Add Testimonial</h1>  
                        </div>                
                     <form  class="form-horizontal" name="frmTestimonials" id="frmTestimonials" action="<?php echo base_url(); ?>add-testimonial" method="POST" >
					 <div class="controls">
                                <label>Name:<span class="mandatory">*</span></label>
                                <div class="input_holder">
                                    <input type="text" name="inputName" class="form-control" id="inputName">
                                </div>
                       </div>
                        <div class="controls">
                                <label>Testimonial:<span class="mandatory">*</span></label>
                                <div class="input_holder">
                                     <textarea name="inputTestimonial" id="inputTestimonial" class="form-control" ></textarea>
                                </div>
                            </div>
					  <div class="controls">
							<div class="col-lg-11">
								&nbsp;
							</div>
							<div class="input_holder">
								<input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" class="pull-right">
								
							</div>
						</div>
                        
                    </form>
                </div>
               </div>
            </section>
        </div>
        <br>           
    </div>
</body>
</html>