<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12" style="margin-bottom: 15px;">
						<h4 class="card-title mb-0">Form Add Users</h4>
					</div>
				
					<div class="col-sm-12">
              <form id="form_add_user" action="<?= base_url(); ?>user/add_proccess" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="userid" id="userid" class="form-control" placeholder="username">
                    </div>

                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="full name">
                    </div>
                    
                    <div class="form-group">
                      <label>ROLE</label>
                      <select id="role" name="role" class="form-control">
                        <option value="">Admin BAST</option>
                        <option value="">Admin Project</option>
                        <option value="ADMINISTRATOR">Administrator</option>
                        <option value="AM">Account Manager</option>
                        <option value="GUEST">Guest</option>
                        <option value="PM">Project Manager</option>
                        <option value="">Project Manager Officer</option>
                      </select>
                    </div>  
                
                    <div class="form-group">
                      <label>Division</label>
                      <select class="form-control" name="division" id="division">
                        <option value="DES">DES</option>
                        <option value="DSS">DSS</option>
                        <option value="SUBSIDIARY">SUBSIDIARY</option>
                      </select>
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="number" name="phone" id="phone" class="form-control" placeholder="08xxx xxxx xxxx">
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" id="email" class="form-control" placeholder="user@domain">
                    </div>
                    
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="create password">
                    </div>

                    <div class="form-group">
                      <label>Re-Type Password</label>
                      <input type="password" name="c_password" id="c_password" class="form-control" placeholder="confirm password">
                    </div>
                    
                    <div class="form-group">
                      <label>Regional</label>
                      <select id="regional" name="regional" class="form-control">
                        <option value="0">HO</option>
                        <option value="1">Regional</option>
                        <option value="2">Regional</option>
                        <option value="3">Regional</option>
                        <option value="4">Regional</option>
                        <option value="5">Regional</option>
                        <option value="6">Regional</option>
                        <option value="7">Regional</option>
                      </select>
                    </div>

                  </div>

                    <button type="submit" class="col-md-2 offset-md-5 btn btn-info text-left btn-brand btn-sm">
                        <i class="fa fa-plus"></i><span> add user </span>
                    </button>
                </div>
              </form>

					</div>
				</div>


			</div>
	

		</div>
	</div>
</div>


<script type="text/javascript">    
  var Page = function () {
  
      return {
          init: function() {  

           }
      };

  }();

  jQuery(document).ready(function() { 
      Page.init();
  });       
           
</script>