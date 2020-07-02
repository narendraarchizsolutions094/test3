<?php
$comp = $tab_row['comp_id'];
$comp_ids = array();
if(!empty($comp)) {
	$comp_ids = explode(',', $comp);
}
?>
<input type="hidden" name="tab_id" value="<?=$tab_row['id']?>">
<div class="row">
    <div class="form-group col-md-12">
        <label>Tab Name</label>
        <input class="form-control" name="tab_name" placeholder="Tab name" type="text" value="<?=$tab_row['title']?>" required>
    </div>
    <div class="form-group col-md-12">
        <label>Company</label>                                            
        <select class="form-control " name="comp_ids[]" multiple id="edit_tab_comp">                                                
            <?php foreach($company_list as $key=>$company){?>
                <option value="<?=$company->user_id ?>" <?php if (in_array($company->user_id, $comp_ids)) { echo "selected"; } ?> >
                    <?php echo empty($company->a_companyname)?$company->firstname.' '.$company->lastname:$company->a_companyname ?>
                </option>
                <?php } ?>
        </select>
    </div>
    <div class="sgnbtnmn form-group col-md-12">
        <div class="sgnbtn">
            <input type="submit" value="Update" class="btn btn-success" name="addTab">
        </div>
    </div>
</div>