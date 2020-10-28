<div class="row">
	<div class="col-lg-12 ">
		<?php
		if($suc = $this->session->flashdata('SUCCESSMSG'))
			echo '<div class="alert alert-success">'.$suc.'</div>';
		?>
		<form action="" method="post">
		<div class="panel panel-default">
			<div class="panel-heading">Add Holiday</div>
			<div class="panel-body">

				<div class="form-group col-lg-6">
					<label>Festival Name</label>
					<select name="festival" class="form-control" required>
						<?php
						echo "<option value=''>--- Select Festival---</option>";
							if(!empty($festivals))
							{	$i=1;
								foreach ($festivals->result_array() as $res)
								{
								echo'<option value="'.$res['id'].'">'.$res['festival_name'].'</option>';
								}
							}
						?>
					</select>
				</div>
				<div class="form-group col-lg-6">
					<label>Date</label>
					<input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
				</div>

				<div class="form-group col-lg-3">
					<label>Country</label>
					<select name="country" class="form-control" onchange="find_region(this.value)" required>
						<?php
						echo "<option value=''>--- Select Country---</option>";
							if(!empty($country))
							{	$i=1;
								foreach ($country as $res)
								{
								echo'<option value="'.$res->id_c.'">'.$res->country_name.'</option>';
								}
							}
						?>
					</select>
				</div>
				<div class="form-group col-lg-3">
					<label>Regions</label>
					<select name="region" class="form-control" onchange="find_state(this.value)" required>
					</select>
				</div>
				<div class="form-group col-lg-3">
					<label>State</label>
					<select name="state" class="form-control" onchange="find_city(this.value)" required>
					</select>
				</div>
			<!-- 	<div class="form-group col-lg-3">
					<label>Territory</label>
					<select name="territory" class="form-control" onchange="find_city(this.value)">
					</select>
				</div> -->
				<div class="form-group col-lg-3">
					<label>City</label>
					<select name="city" class="form-control" required>
					</select>
				</div>
				<div class="form-group col-lg-3">
					<label>Status</label><br>
					<input type="radio" name="status" value="1" checked> Active &nbsp; &nbsp;
					<input type="radio" name="status" value="0" required> Inactive<br>
					
					</select>
				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
			</div>
		</div>
		</form>
	</div>

	<div class="col-lg-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>SR.</th>
					<th>Festival Name</th>
					<th>Date</th>
					<th>Day</th>
					<th>State</th>
					<th>City</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if(!empty($holiday_table))
			{	$i=1;
				foreach ($holiday_table as $row)
				{
					echo'<tr>
							<td>'.$i++.'</td>
							<td>'.$row['festival_name'].'</td>
							<td>'.$row['date'].'</td>
							<td>'.(date('l',strtotime($row['date']))).'</td>
							<td>'.$row['state'].'</td>
							<td>'.$row['city'].'</td>
							<td style="text-align:center">'.($row['status']?'<i class="fa fa-check text-success"></i>':'<i class="fa fa-times text-danger"></i>').'</td>
						</tr>';
				}
			}
			?>
			</tbody>
			
		</table>
	</div>
</div>
<script type="text/javascript">
            function find_region(id) {
       
            $.ajax({
            type: 'POST',
            url: '<?=base_url()?>/location/get_region_byid',
            data: {country_id:id}
            })
            .done(function(data){
            if(data!=''){
              $("select[name=region]").html(data);
            }else{
             $("select[name=region]").html(''); 
            }
            })
            .fail(function() {
            
            });
            }
        </script>
        
        <script type="text/javascript">
            function find_territory() 
            {
       			var con = $("select[name=country]").val();
       			var reg = $("select[name=region]").val();
            $.ajax({
            type: 'POST',
            url: 'https://localhost/crm/location/get_tretory_byid',
            data: {country_id:con,region_id:reg}
            })
            .done(function(data){
            if(data!=''){
              $("select[name=territory]").html(data);
            }else{
               $("select[name=territory]").html('');  
            }
            })
            .fail(function() {
            
            });
            }
        </script>
         <script type="text/javascript">
            function find_state() {
            
            var region_id = $("select[name=region]").val();
            
            $.ajax({
            type: 'POST',
            url: 'https://localhost/crm/location/select_state_by_region',
            data: {region_id:region_id},
            
            success:function(data){
                
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].state)+'</option>';
                }
                
                $("select[name=state]").html(html);
                
            }
            
            
            });
            }

             function find_city() 
            {
            
            var state = $("select[name=state]").val();
            
            $.ajax({
            type: 'POST',
            url: 'https://localhost/crm/location/select_city_by_state',
            data: {state_id:state},
            
            success:function(data){
                //alert(data);
                var html='';
                var obj = JSON.parse(data);
                
                html +='<option value="" style="display:none">---Select---</option>';
                for(var i=0; i <(obj.length); i++){
                    
                    html +='<option value="'+(obj[i].id)+'">'+(obj[i].city)+'</option>';
                }
                
                $("select[name=city]").html(html);
                
            }
            
            
            });
            }
        </script>
        
        <script>
            
            $(function(){
                
                $("#state_id").change(function(){
                    
                    var state_id = $("#state_id").val();
                
                $.ajax({
                    
                    url: 'https://localhost/crm/location/select_territory_by_state',
                    type:'POST',
                    data:{state_id:state_id},
                    success:function(data){
                        
                        var html='';
                        var obj = JSON.parse(data);
                        
                        html +='<option value="" style="display:none">---Select---</option>';
                        for(var i=0; i <(obj.length);i++){
                            
                            html +='<option value="'+(obj[i].territory_id)+'">'+(obj[i].territory_name)+'</option>';
                        }
                        
                        $("#territory_id").html(html);
                    }
                    
                    
                });
                    
                });
                
                
                
            });
        </script>